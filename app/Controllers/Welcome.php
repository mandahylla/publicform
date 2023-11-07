<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;



class Welcome extends BaseController
{
	
	public function index()
	{
		if (session()->get('isLoggedIn') == TRUE) {

			return redirect()->to(base_url('home'));
		}
		return view('common/login');
	}

	public function condition()
	{
		if (session()->get('isLoggedIn') == TRUE) {

			return redirect()->to(base_url('home'));
		}
		return view('common/conditions');
	}

	public function login()
	{
		if (!$this->validate(['inputEmail' => 'required|valid_email'])) {
			session()->setFlashdata('notif_error', '<b>'.$this->validation->getError('inputEmail').' !</b>');
			return view('common/login');
			//session()->remove('notif_error');
		} else {
			
			$inputEmail 	= htmlspecialchars($this->request->getVar('inputEmail', FILTER_UNSAFE_RAW));
			$inputPassword 	= htmlspecialchars($this->request->getVar('inputPassword', FILTER_UNSAFE_RAW));
			$user 			= $this->userModel->getUser(username: $inputEmail);	

			if($user) {
										
				if($user['is_active'])
				{
					$password = $user['password'];
					$verify   = password_verify($inputPassword, $password);

					if ($verify) {
						session()->set([
							'username'		=> $user['username'],
							'role'			=> $user['role'],
							'isLoggedIn' 	=> TRUE
						]);
						return redirect()->to(base_url('home'));

					} else {
						session()->setFlashdata('notif_error', '<b>Identifiant ou Mot de passe incorrect !</b>');
					}
				}
				if(!$user['is_active'] AND (!empty($user['code_date']) AND !$this->verifyExperyTime($user['code_date'])))
				{
					$this->userModel->deleteUser($user['userID']);
					$this->bankAccountModel->deleteUserBankAccount($user['userID']);
				}
				
			} else {
				session()->setFlashdata('notif_error', '<b>Identifiant ou Mot de passe incorrect !</b>');				
			}
		}
		return redirect()->to(base_url());
	}
	
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to(base_url('/'));
	}

	public function forbiddenPage()
	{
		$data = array_merge($this->data, [
			'title'  => 'Accès Interdit'
		]);
		return view('common/forbidden', $data);
	}

	public function register()
	{
		if (session()->get('isLoggedIn') == TRUE) {

			return redirect()->to(base_url('home'));
		}

		$now            = Time::now('Africa/Brazzaville');
        $doelimit       = Time::parse('+ 1 week','Africa/Brazzaville');
        $dovlimit       = Time::parse('+ 3 month','Africa/Brazzaville');
		
		$data = array_merge($this->data, [

			'title'     => '1ère Demande et Inscription',
            'page'      => 'Faire sa Première demande et s\'inscrire',
            'Demands'   => $this->demandModel->getDemands(),
            'formulas'  => $this->const->loadFormula(),
            'purposes'  => $this->const->loadPurpose(),
            'bc_types'  => $this->const->loadBcType(),
            'countries' => $this->countryModel->getNoCemacCountries(),
            'now'       => $now,
            'doe'       => $doelimit,
            'dov'       => $dovlimit,
		]);
		return view('common/register', $data);
	}

	public function registration()
	{
        $now            = Time::now('Africa/Brazzaville');
        $doelimit       = Time::parse('+ 1 week','Africa/Brazzaville');
        $dovlimit       = Time::parse('+ 3 month','Africa/Brazzaville');

        $data = array_merge($this->data, [

            'title'     => '1ère Demande et Inscription',
            'page'      => 'Faire sa Première demande et s\'inscrire',
            'Demands'   => $this->demandModel->getDemands(),
            'formulas'  => $this->const->loadFormula(),
            'purposes'  => $this->const->loadPurpose(),
            'bc_types'  => $this->const->loadBcType(),
            'countries' => $this->countryModel->getNoCemacCountries(),
            'now'       => $now,
            'doe'       => $doelimit,
            'dov'       => $dovlimit,
        ]);

        $rules = [
            'inputFullname' 	=> ['label' => 'Nom complet', 'rules' => 'required','errors' => ['required' => 'Vous devez entrer votre nom complet']],
            'inputEmail' 		=> ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.username]','errors' => ['required' => 'Vous devez entrer un email valide','valid_email' => 'Vous devez entrer un email valide','is_unique' => 'Cet email est déjà utilisé']],
            'inputTel' 			=> ['label' => 'Téléphone', 'rules' => 'required|regex_match[/^\+?([0-9] ?){9,20}$/]|is_unique[users.wphone]','errors' => ['required' => 'Ce numéro de téléphone n\'est pas valide','regex_match'=>'Ce numéro de téléphone n\'est pas valide','is_unique' => 'Ce numéro est déjà utilisé']],
            'inputBa2' 			=> ['label' => 'Compte Bancaire', 'rules' => 'required|max_length[24]|numeric|repeated[bank_accounts.acc_num]','errors' => ['required' => 'Ce numéro de compte n\'est pas valide','numeric'=>'Ce numéro de téléphone n\'est pas valide','repeated' => 'Ce compte est déjà utilisé']],
            'inputPassword' 	=> ['label' => 'Password', 'rules' => 'required|min_length[5]|alpha_numeric','errors' => ['min_length' => 'Votre mot de passe doit avoir plus de 5 caractères','required' => 'Vous devez entrer un mot de passe valide']],
            'inputPassword2' 	=> ['label' => 'Password Confirmation', 'rules' => 'matches[inputPassword]','errors' => ['matches' => 'Le 2è mot de passe entré ne correspond pas au 1er']],
        ];

        $errors = [
                'inputBa' => [
                    'repeated' => 'Le compte Bancaire ne peut dépasser 2 utilisateurs'
				],
				'inputFullname' 	=> [
					'required' => 'Vous devez entrer votre nom complet'
				],
				'inputEmail' 		=> [
					'required' => 'Vous devez entrer un email valide',
					'valid_email' => 'Vous devez entrer un email valide',
					'is_unique' => 'Cet email est déjà utilisé'
				],
				'inputTel' 			=> [
					'required' => 'Ce numéro de téléphone n\'est pas valide',
					'regex_match'=>'Ce numéro de téléphone n\'est pas valide',
					'is_unique' => 'Ce numéro est déjà utilisé'
				],
				'inputBa2' 			=> [
					'required' => 'Ce numéro de compte n\'est pas valide',
					'numeric' =>'Ce numéro de téléphone n\'est pas valide',
					'repeated' => 'Ce compte est déjà utilisé'
				],
				'inputPassword' 	=> [
					'min_length' => 'Votre mot de passe doit avoir plus de 5 caractères',
					'required' => 'Vous devez entrer un mot de passe valide'
				],
				'inputPassword2' 	=> [
					'matches' => 'Le 2è mot de passe entré ne correspond pas au 1er'
				],
		  
            ];

		if (!$this->validate($rules,$errors)) {

			$data ;
			session()->setFlashdata('notif_error', $this->validation->getError('inputPassword2') ."<br/>". $this->validation->getError('inputBa'). ' ' . $this->validation->getError('inputTel'). ' ' . $this->validation->getError('inputEmail'));

		} else {
			$inputFullname 		= htmlspecialchars($this->request->getVar('inputFullname', FILTER_UNSAFE_RAW));
			$inputEmail 		= htmlspecialchars($this->request->getVar('inputEmail', FILTER_UNSAFE_RAW));
			$inputTel 	 		= htmlspecialchars($this->request->getVar('inputTel', FILTER_UNSAFE_RAW));
			$inputBa1 	 		= htmlspecialchars($this->request->getVar('inputBa1', FILTER_UNSAFE_RAW));
			$inputBa2 	 		= htmlspecialchars($this->request->getVar('inputBa2', FILTER_UNSAFE_RAW));
			$inputBa3 	 		= htmlspecialchars($this->request->getVar('inputBa3', FILTER_UNSAFE_RAW));
			$inputBa4 	 		= htmlspecialchars($this->request->getVar('inputBa4', FILTER_UNSAFE_RAW));
			$inputPassword 		= htmlspecialchars($this->request->getVar('inputPassword', FILTER_UNSAFE_RAW));
			//generate simple random code
			$inputLink 			= random_string('alnum', 20);

			$dataUser			= [
				'inputFullname' => $inputFullname,
				'inputUsername' => $inputEmail,
				'inputTel' 		=> $inputTel,
				'inputLink'		=> $inputLink,
				'inputCodeDate' => Time::now('Africa/Brazzaville'),
				'inputPassword' => $inputPassword,
				'inputRole' 	=> 3,
				'inputCreatedAt'=> Time::now(),

			];

			$inputBa			= $inputBa1.$inputBa2.$inputBa3.$inputBa4;
			$account 			= $this->bankAccountModel->getBankAccounts(BankAccounts: $inputBa);

			if(!empty($account) AND (count($account)>= 2) ){
				$data ;
				session()->setFlashdata('notif_error', 'Ce numéro de compte existe déjà pour 2 utilisateurs');
			} else {

				$registration		= $this->userModel->createUser($dataUser);
				if($registration)
				{
					$userId 			= $this->userModel->getLastInsertID();	
					
					$dataBankAccounts	= [
						'inputIdUser' 	=> $userId,
						'inputAccNum' 	=> $inputBa
					];					
	
					$ba_insert = $this->bankAccountModel->createBankAccount($dataBankAccounts);
	
					if($ba_insert)
					{
						$user = $this->userModel->getUser(userID: $userId);
						$note = $this->userNote($inputEmail, $inputPassword, $inputLink);

						if($note == true)
						{
							session()->setFlashdata('notif_success', '<b>Votre demande et votre inscription a été enregistré avec succès !</b> Veuillez consulter votre mail pour activer votre inscription.');    
							return redirect()->to(base_url());                
						}
						elseif(!empty($note))
						{
							session()->setFlashdata('notif_error', '<b>Une erreur a été constaté : </b>'.$note.' !<br /> Veuillez contacter un administrateur');
						}			
					}	
							
				}
			}			
		}
		return view('common/register',$data);
	}

	public function activate($token=null)
	{		
		if(!empty($token))
		{
			$userData = $this->userModel->verifyToken($token);
			
			if($userData)
			{
				if($this->verifyExperyTime($userData['code_date']))
				{
					if(!$userData['is_active'])
					{
						$currTime = Time::now();
						$this->userModel->activate($token,$currTime);

						session()->setFlashdata('notif_success', "Votre inscription a été activée avec succès ! Connectez vous pour ouvrir une demande");
						// Notifier le banquier d'une nouvelle inscription
						$sendEmail = 'cedrick-marc.mandahylla@creditducongo.com';
						$this->banker_note($userData,$sendEmail);
					}					
					else{
						session()->setFlashdata('notif_success', "Cette inscription est déjà active");
					}
				}
				else{
					session()->setFlashdata('notif_error', "Désolé ! votre lien d'activation a expiré");
				}
			}
			else{
				session()->setFlashdata('notif_error', "Désolé ! vous n'êtes pas encore enregistré sur la plateforme");
			}			
		}
		return redirect()->to(base_url());
	}

	public function forgotPassword()
	{
		$data = [];

		if($this->request->is('post'))
		{
			if (!$this->validate([

					'inputEmail' 	=> ['label' => 'Email', 'rules' => 'required|valid_email'],
				]))
		 	{
				$data = array_merge($this->data, [
					'title'         => 'Mot de passe perdu',
				]);

				session()->setFlashdata('notif_error', $this->validation->getError('inputEmail'));
			}
			else
			{			
				$email    = $this->request->getVar('inputEmail', FILTER_UNSAFE_RAW);
				$userData = $this->userModel->verifyEmail($email);
				$userId   =  $userData['id'];
			
				if(!empty($userData))
				{
					$token 	 = random_string('alnum', 20);
					$this->userModel->updateLink($userId,$token,Time::now(),Time::now());

					// mail au client pour envoyer le lien 		
		    
		    		$this->userPasswordNote($userData,$email,$token);
				}
				else{

					session()->setFlashdata('notif_error', 'Désolé cette email n\'existe pas !' );

					return redirect()->route('register');
				}
			}
		}
		return view('common/forgot_password',$data);
	}

	public function resetPassword($user_id,$token=null)
	{		
		$data = [];
		
		if(!empty($token))
		{
			$userData = $this->userModel->verifyToken($token);
			
			if(!empty($userData) AND ($userData['id'] == $user_id))
			{
				if($this->verifyExperyTime($userData['code_date']))
				{ //dd($userData);
					$data = array_merge($this->data, ['v_error' =>  1, 'userData' => $userData]);
					return view("common/reset_password",$data);					
				}
				else
				{
					$data = array_merge($this->data, ['v_error' =>  0]);
					session()->setFlashdata('notif_error', "Désolé ! Ce lien d'accès à expirer.");
				}
			}
			else
			{
				$data = array_merge($this->data, ['v_error' =>  0]);
				session()->setFlashdata('notif_error', "Désolé ! vous n'êtes pas enregistré sur la plateforme");
			}			
		}
		//echo ($token ." ".$user_id);
		return view("common/reset_password/",$data);
	}

	public function renewPassword($id)
	{
		// dd($id);
		$rules = [
			'inputPassword' 	=> [ 
				'label' => 'Password', 
				'rules' => 'required|min_length[6]|alpha_numeric',
			], 

			'inputPassword2' 	=> [
				'label' => 'Password Confirmation',
				'rules' => 'matches[inputPassword]'
			]

		];

		if (!$this->validate($rules)) 
		{
			$data = array_merge($this->data, [
				'title'         => 'Changer de mot de passe',
			]);
			session()->setFlashdata('notif_error', $this->validation->getError('inputPassword') ."<br/>".'notif_error', $this->validation->getError('inputPassword2'));
		}
		else
		{
			$inputPassword = htmlspecialchars($this->request->getVar('inputPassword', FILTER_UNSAFE_RAW));

			$user 	   = $this->userModel->getUser(userID: $id);
			//dd($dataUser);
			$dataUser 	   = array_merge($this->data, [

				'userID'		 => $id,
				'inputPassword'	 => $inputPassword,
				'inputUpdatedAt' => Time::now(),
			]);

			// dd($dataUser);

			if($this->userModel->updateUserPassword($dataUser)){

				$this->userPasswordResetedNote($user);
				session()->setFlashdata('notif_success', "Votre mot de passe a été modifié avec succès !");				
				return redirect()->to(base_url());
			}
		}

		return view("common/reset_password",$data);
	}

/* 	public function registerMultiple() {

        if ($this->request->is('post')) {
            
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
            $this->form_validation->set_rules('address', 'Contact Address', 'trim|required');

            if ($this->form_validation->run() !== FALSE) {
                $result = $this->usermodel->insert_user($this->input->post('name'), $this->input->post('password'), $this->input->post('email'), $this->input->post('phone'), $this->input->post('gender'), $this->input->post('dob'), $this->input->post('address'));
                $data['success'] = $result;
                return view('user_register', $data);
            } else {
                return view('user_register');
            }
        } else {
            return view('user_register');
        }
    } */

	public function verifyExperyTime($regTime)
	{
		$currTime = now();
		$regTime  = strtotime($regTime);
		$diffTime = (int)$currTime - (int)$regTime;

		if(1800 > $diffTime)
		{
			return true;
		}
		return false;
	}

	private function userNote($inputEmail, $inputPassword, $inputLink){

		$mail = $this->mail->load();

		$subject = 'Activer votre inscription';
		$message = 	"
					<html lang='fr'>
					<head>
						<meta charset='utf-8'>
						<title>Dotation de Devises</title>
					</head>
					<body>
						<h2>Demande de Dotation de Devises.</h2>
						<p>Votre demande a été enregistré avec succès et transmis pour traitement.</p>
						<p>Pour suivre l'état de traitement de votre demande, merci de vous êtes enregistré vérifions ensemble Votre compte :</p>
						<p>Email : ".$inputEmail."</p>
						<p>Mot de Passe : ".$inputPassword."</p>
						<p>Veuillez clicker sur le lien suivant pour activer le compte et suivre ainsi votre demande :</p>
						<h4><a href='".base_url()."activation/".$inputLink."'>Activer Mon Compte</a></h4>
					</body>
					</html>
					";
		$mail->SetFrom('Noreply@creditducongo.com', 'Crédit du Congo');
	    $mail->AddAddress($inputEmail);
	    $mail->Subject  = $subject;
	    $mail->Body 	= $message;

	    //sending email
	    if($mail->send())
	    {
	    	session()->setFlashdata('notif_success', '<b>Vous avez été enregistré !</b> Veuillez consulter votre mail pour activer votre compte et vous connecter<br/> ce lien est valable 30 minutes');
	    	return redirect()->to(base_url());
	    }
	    else
	    {
	    	session()->setFlashdata('notif_error', $mail->ErrorInfo);
 
	    }

	}

	private function userPasswordNote($userData,$email,$token){

		$mail = $this->mail->load();

		$subject = 'Changer mot de passe';
		$message = 	"	<html lang='fr'>
						<head>
							<meta charset='utf-8'>
							<title>Changer De Mot de Passe</title>
						</head>
						<body>
							<h2>Modifier votre Mot de Passe.</h2>
							<p>Bonjour M. ".$userData['fullname']."</p>
							<p>Votre requête a bien été reçu !</p>
							<p>Cliquez sur le lien suivant pour changer votre mot de pass : </p>
							<h4><a href='".base_url()."login/reset_password/".$userData['id']."/".$token."'>Cliquez ici</a></h4>
							<p>Cordialement.</p>
						</body>
						</html>
					";
		$mail->SetFrom('Noreply@creditducongo.com', 'Crédit du Congo');
	    $mail->AddAddress($email);
	    $mail->Subject  = $subject;
	    $mail->Body 	= $message;

	    //sending email
	    if($mail->send())
	    {
	    	session()->setFlashdata('notif_success', '<b>Un lien vous a été envoyé !</b> Vous avez reçu un mail avec un lien pour changer votre mot de pass ! <br/> ce lien est valable 30 minutes');
	    	return redirect()->to(base_url());
	    }
	    else
	    {
	    	session()->setFlashdata('notif_error', $mail->ErrorInfo);
 
	    }

	}

	private function userPasswordResetedNote($userData){

		$mail = $this->mail->load();

		$subject = 'Changement mot de passe';
		$message = 	"	<html lang='fr'>
						<head>
							<meta charset='utf-8'>
							<title>Changement De Mot de Passe</title>
						</head>
						<body>
							<h2>Modifier votre Mot de Passe.</h2>
							<p>Bonjour M. ".$userData['fullname']."</p>
							<p>Votre mot de passe a bien été réinitiallisé !</p>
							<p>Si vous n'êtes pas l'auteur de cette action veuillez contacter votre Gestionnaire </p>
							<h4><a href='".base_url()."'>Cliquez ici pour accéder à la plateforme</a></h4>
							<p>Cordialement.</p>
						</body>
						</html>
					";
		$mail->SetFrom('Noreply@creditducongo.com', 'Crédit du Congo');
	    $mail->AddAddress($userData['username']);
	    $mail->Subject  = $subject;
	    $mail->Body 	= $message;

	    //sending email
	    if($mail->send())
	    {
	    	session()->setFlashdata('notif_success', '<b>Un lien vous a été envoyé !</b> Vous avez reçu un mail avec un lien pour changer votre mot de pass ! <br/> ce lien est valable 30 minutes');
	    	return redirect()->to(base_url());
	    }
	    else
	    {
	    	session()->setFlashdata('notif_error', $mail->ErrorInfo);
 
	    }

	}

	private function banker_note($userData,$sendEmail)
	{
		$mail 	 = $this->mail->load();

		$subject = 'Activation d\'inscription';
		$message = 	"
					<html lang='fr'>
					<head>
						<meta charset='utf-8'>
						<title>Activation</title>
					</head>
					<body>
						<h2>Activation d'une inscription</h2>
						<p>Un client vient d'activer son inscription, il s'agit de :</p>
						<p>Nom : ".$userData['fullname']."</p>
						<p>Email : ".$userData['username']."</p>
						<p>Veuillez clicker sur le lien suivant pour accéder à la plateforme :</p>
						<h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
					</body>
					</html>
					";
		$mail->SetFrom('Noreply@creditducongo.com', 'Alerte Crédit du Congo');
	    $mail->AddAddress($sendEmail);
	    $mail->Subject  = $subject;
	    $mail->Body 	= $message;

	    //sending email
	    if($mail->send())
	    {
	    	return true;
	    }
	    else
	    {
	    	return $mail->ErrorInfo;
	    }
	}
}
