<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
	public function index()
	{
		$user    = $this->userModel->getUser(username: session()->get('username'));
        $demands = $this->demandModel->getUserDemands();
		$lastValidDemand = $this->demandModel->checkLastValidDemand($user['userID']);
		$today	 = Time::today();	
		$receivedDemands = 0;	
		$newMonthDemands = 0;
		$newDayDemands = 0;
		$traitingDemands = 0;
		$closedDemands = 0;
		$closedMDemands = 0;
		$waitingDemands = 0;
		$waitingMDemands = 0;
		$enabledDemands = 0;
		$enabledDayDemands = 0;
		$dayDemands = 0;
		$rowDates = [];

		/* if($lastValidDemand)
		{
			$delai = checkDovAndDom($lastValidDemand['bcdov'], $lastValidDemand['bcdom']);// fonction réalisée dans le helper userdemands
			// echo $delai; exit;
			if(isset($delai) AND ($delai>7))
			{
				$this->sendAlertExpireBcMail($lastValidDemand['id'], $user['username'],'cedrick-marc.mandahylla@creditducongo.com', $user['fullname']);

			}

		} */

		foreach($demands as $row)
		{
			$rowDate 	  = Time::parse($row['doc'],'Africa/Brazzaville');
			$correctDay   = false ;
			$correctMonth = false ;
			
						
			if(($today->year === $rowDate->year))
			{				
				if($today->month === $rowDate->month){
					$correctMonth = true ;
					
					if($today->day === $rowDate->day){
						$correctDay = true ;
						$dayDemands++;						
					} 
				} 					
			}
				
			if($row['statusOrder']  === '4') $closedDemands++;
			if(($row['statusOrder']  === '4') AND ($correctMonth)) $closedMDemands++;
			if(($row['statusOrder']  === '3') AND ($correctMonth)) $enabledDemands++;
			if(($row['statusOrder']  === '3') AND ($correctDay)) $enabledDayDemands++;
			if($row['statusOrder']  === '2') $waitingDemands++;
			if(($row['statusOrder']  === '2') AND ($correctMonth)) $waitingMDemands++;
			if($row['statusOrder']  === '1') $traitingDemands++;
			if(($row['statusOrder'] === '1') AND ($correctMonth)){ $newMonthDemands++; }
			if(($row['statusOrder'] === '1') AND ($correctDay)){  $newDayDemands++; }
		}
		// dd($enabledDemands);
		// dd($rowDates);
        if($user['role_name'] === 'Client'){
           $demands =  $this->demandModel->getUserDemands($user['userID']);
        }

        $data = array_merge($this->data, [
            'title'           => 'Accueil',
            'demands'         => $demands,
			'traitingDemands' => $traitingDemands,
	        'closedDemands'	  => $closedDemands,
			'closedMDemands'  => $closedMDemands,
			'enabledDemands'  => $enabledDemands,
			'enabledDayDemands' => $enabledDayDemands,
			'waitingDemands'  => $waitingDemands,
			'waitingMDemands' => $waitingMDemands,
			'newMonthDemands' => $newMonthDemands,
			'newDayDemands'   => $newDayDemands,
			'dayDemands'   	  => $dayDemands,
            'user'            => $user,
            'status'          => $this->statusModel->getStatus(),
        ]);
		return view('common/home', $data);
	}

	private function sendAlertExpireBcMail($id, $inputEmail, $bankEmail, $customer)
	{		
		$mail = $this->mail->load();

        $subject = 'Activation de carte hors CEMAC';
        $message =  "
                    <html>
                    <head>
						<meta charset='utf-8'>
                        <title>Activation de Plafond</title>
                    </head>
                    <body>
                        <h2>ALERTE EXPIRATION DE MA CARTE.</h2>
                        <p>Bonjour M. votre carte associé à la demande en cours est expiré.<br/>
                           Veuillez contacter votre gestionnaire pour renouveller votre carte.<br/>
                           Ou vous pouvez accéder à la plateforme pour suivre L'état de votre demande</p>
                        <p>Cordialement. </p>                        
                        <h4><a href='".base_url()."'>Suivre ma demande</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Noreply@creditducongo.com', 'Activation de carte hors CEMAC');
        $mail->AddAddress($inputEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

        //Envoi de l'email
        if($mail->send())
        {
			$data = [
				'dom' => Time::now(),
				'id'  => $id
			];
			$this->demandModel->updateDom($data);

			$subject = 'Activation de carte hors CEMAC';
			$message =  "
						<html lang='fr'>
						<head>
							<meta charset='utf-8'>
							<title>Activation de Plafond</title>
						</head>
						<body>
							<h2>ALERTE EXPIRATION DE CARTE.</h2>
							<p>La carte du client : ".$customer." associé à la demande en cours a expiré.<br/>
							   Veuillez le contacter pour un renouvellement de sa carte.<br/>
							<p>Cordialement. </p>                        
							<h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
						</body>
						</html>
						";
			$mail->SetFrom('Noreply@creditducongo.com', 'Activation de carte hors CEMAC');
			$mail->AddAddress($bankEmail);
			$mail->Subject  = $subject;
			$mail->Body     = $message;
           return true;

        }
        else
        {
            return $mail->ErrorInfo;
        }		
	}
}
