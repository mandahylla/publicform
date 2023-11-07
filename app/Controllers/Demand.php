<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Demand extends BaseController
{

// Constructor
                
    function __construct()
    {
        
    }
                
// Read
                
    public function index()
    {
        $user    = $this->userModel->getUser(username: session()->get('username'));
        $demands = $this->demandModel->getUserDemands();

        $data = array_merge($this->data, [
                    'title'     => 'Demande de dotation de Devises de la carte bancaire',
                    'demands'   => $demands,
                    'user'      => $user,
                    'status'    => $this->statusModel->getStatus(),
                    'formulas'  => $this->const->loadFormula(),
                    'countries' => $this->countryModel->getNoCemacCountries()
                ]);

        if($user['role_name'] === 'Client'){
          
           $demands =  $this->demandModel->getUserDemands($user['userID']); 
           $data     = array_merge($data, ['demands'=> $demands]);
                 
            return view('customer/demandList', $data);
        }      

        return view('banker/demandList', $data);
    }
                
// Insert

public function addForm()
    {
        $now            = Time::now('Africa/Brazzaville');
        $doelimit       = Time::parse('+ 1 week','Africa/Brazzaville');
        $dovlimit       = Time::parse('+ 3 month','Africa/Brazzaville');

        $data = array_merge($this->data, [
            'title'     => 'Demande de dotation de Devises de la carte bancaire',
            'page'      => 'Ajouter une demande',
            'Demands'   => $this->demandModel->getDemands(),
            'formulas'  => $this->const->loadFormula(),
            'purposes'  => $this->const->loadPurpose(),
            'bc_types'  => $this->const->loadBcType(),
            'countries' => $this->countryModel->getNoCemacCountries(),
            'now'       => $now,
            'doe'       => $doelimit,
            'dov'       => $dovlimit,
        ]);
        return view('customer/demandAdd', $data);
    }
                
    public function createDemands()
    {
        $user = $this->userModel->getUser(username: session()->get('username'));
        $now            = Time::now('Africa/Brazzaville');
        $doelimit       = Time::parse('+ 1 week','Africa/Brazzaville');
        $dovlimit       = Time::parse('+ 3 month','Africa/Brazzaville');

        $data = array_merge($this->data, [
            'title'     => 'Demande de dotation de Devises de la carte bancaire',
            'page'      => 'Ajouter une demande',
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
            'inputDobt'         => [
                'label' => 'Date Début Voyage', 
                'rules' => 'valid_date',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            'inputDoet'         => [
                'label' => 'Date Fin Voyage', 
                'rules' => 'valid_date',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            'inputBcnum'        => [
                'label' => 'Numéro carte Bancaire', 
                'rules' => 'numeric|digitCheck',
                'errors' => [
                    'required'   => 'le champ est obligatoire',
                    'digitCheck' => 'Vous devez entrer 4 chiffres obligatoirement'
                ]
            ],
            'inputCountry'      => [
                'label' => 'Pays', 
                'rules' => 'required',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            'inputPasspNum'     => [
                'label' => 'N° Passeport', 
                'rules' => 'required|alpha_numeric|is_unique[demands.passport_num]',
                'errors' => [
                    'required'  => 'le champ est obligatoire',
                    'is_unique' => 'Ce numéro de passeport existe déjà',
                ]
            ],
			'inputDov'    		=> [
                'label' => 'Valable jusqu\'au', 
                'rules' => 'required',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
			'inputBcDov'    	=> [
                'label' => 'Valable jusqu\'au', 
                'rules' => 'required',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            
            'inputVisaScan'     => [
                'rules' => 'uploaded[inputVisaScan]|ext_in[inputVisaScan,jpg,jpeg,png,pdf]|max_size[inputVisaScan,2048]',
                'errors' => [
                    'uploaded' => 'le champ est obligatoire',
                    'ext_in'   => 'Le fichier doit-être une image ou un document pdf',
                    'max_size' => 'Le fichier ne doit pas être supérieur à 2Mo'
                ]
            ],
            'inputPassportScan' => [
                'rules' => 'uploaded[inputPassportScan]|ext_in[inputPassportScan,jpg,jpeg,png,pdf]|max_size[inputPassportScan,2048]',
                'errors' => [
                    'uploaded' => 'le champ est obligatoire',
                    'ext_in'   => 'Le fichier doit-être une image ou un document pdf',
                    'max_size' => 'Le fichier ne doit pas être supérieur à 2Mo'
                ]
            ],
            'inputTicketScan'   => [
                'rules' => 'uploaded[inputTicketScan]|ext_in[inputTicketScan,jpg,jpeg,png,pdf]|max_size[inputTicketScan,2048]',
                'errors' => [
                    'uploaded' => 'le champ est obligatoire',
                    'ext_in'   => 'Le fichier doit-être une image ou un document pdf',
                    'max_size' => 'Le fichier ne doit pas être supérieur à 2Mo'
                ]
            ],
            
        ];

        if (!$this->validate($rules)) {

            $dobtError = (!empty($this->validation->getError('inputDobt'))? $this->validation->getError('inputDobt').'<br/>': '');
            $doetError = (!empty($this->validation->getError('inputDoet'))? $this->validation->getError('inputDoet').'<br/>': '');
            $bcnumError = (!empty($this->validation->getError('inputBcnum'))? $this->validation->getError('inputBcnum').'<br/>': '');
            $bcDovError = (!empty($this->validation->getError('inputBcDov'))? $this->validation->getError('inputBcDov').'<br/>': '');
            $countryError = (!empty($this->validation->getError('inputCountry'))? $this->validation->getError('inputCountry').'<br/>': '');
            $passpNumError = (!empty($this->validation->getError('inputPasspNum'))? $this->validation->getError('inputPasspNum').'<br/>': '');
            $dovError = (!empty($this->validation->getError('inputDov'))? $this->validation->getError('inputDov').'<br/>': '');
            $visaScanError = (!empty($this->validation->getError('inputVisaScan'))? $this->validation->getError('inputVisaScan').'<br/>': '');
            $passportScanError = (!empty($this->validation->getError('inputPassportScan'))? $this->validation->getError('inputPassportScan').'<br/>': '');
            $ticketScanError = (!empty($this->validation->getError('inputTicketScan'))? $this->validation->getError('inputTicketScan').'<br/>': '');
            $now            = Time::now('Africa/Brazzaville');

            session()->setFlashdata('notif_error',  $dobtError.$doetError.$bcnumError.$bcDovError.$countryError.$passpNumError.$dovError
                                                    .$visaScanError.$passportScanError.$ticketScanError);        
            return view('customer/demandAdd', $data);
        } 
        else 
        {
            $inputDobt          = htmlspecialchars($this->request->getVar('inputDobt', FILTER_UNSAFE_RAW));
            $inputDoet          = htmlspecialchars($this->request->getVar('inputDoet', FILTER_UNSAFE_RAW));
            $inputCountry       = htmlspecialchars($this->request->getVar('inputCountry', FILTER_UNSAFE_RAW));
            $inputPasspNum      = htmlspecialchars($this->request->getVar('inputPasspNum', FILTER_UNSAFE_RAW));
            $inputDov           = htmlspecialchars($this->request->getVar('inputDov', FILTER_UNSAFE_RAW));
            $inputBcType        = htmlspecialchars($this->request->getVar('inputBcType', FILTER_UNSAFE_RAW));
            $inputBcnum         = htmlspecialchars($this->request->getVar('inputBcnum', FILTER_UNSAFE_RAW));
            $inputBcForm        = htmlspecialchars($this->request->getVar('inputBcForm', FILTER_UNSAFE_RAW));            
            $inputBcDov         = htmlspecialchars($this->request->getVar('inputBcDov', FILTER_UNSAFE_RAW));
            $inputStP           = htmlspecialchars($this->request->getVar('inputStP', FILTER_UNSAFE_RAW));
            $inputVisaScan      = $this->request->getFile('inputVisaScan');
            $inputPassportScan  = $this->request->getFile('inputPassportScan');
            $inputTicketScan    = $this->request->getFile('inputTicketScan');
            
            $dataDemand  = [                            
                'inputDobt'         => $inputDobt,
                'inputDoet'         => $inputDoet,
                'inputPasspNum'     => $inputPasspNum,
                'inputDov'          => $inputDov,
                'inputBcForm'       => $inputBcForm,
                'inputBcType'       => $inputBcType,
                'inputBcnum'        => $inputBcnum,
                'inputBcDov'        => $inputBcDov,
                'inputDestination'  => $inputCountry,
                'inputStP'          => $inputStP,
                'inputStatus'       => '1',
                'inputCreatedAt'    => Time::now(),
                'inputCreatedBy'    => $user['userID'],
                'inputModifiedBy'   => $user['userID'],                
            ];

            $demand  = $this->demandModel->createDemands($dataDemand);

            if ($demand) {

                $demandId = $this->demandModel->getLastInsertID();
                // dd($demandId);
                
                if (!($inputVisaScan->hasMoved()))
                {
                    $renamedFile = $inputVisaScan->getRandomName();
                    $fileType    = $inputVisaScan->getExtension();

                    $dataFile = [
                        'inputDemandId'   => $demandId,
                        'inputUploadedAt' => Time::now(),
                        'inputCreatedAt'  => Time::now(),
                        'inputUpdatedAt'  => Time::now(),
                        'inputFileType'   => $fileType, 
                        'inputFileName'   => $renamedFile,
                        'inputDocType'    => "Visa ou équivalent",
                    ];

                    $inputVisaScan->move(WRITEPATH . 'uploads',$renamedFile);
                    $this->uploadModel->createUpload($dataFile);
                }

                if (!($inputPassportScan->hasMoved()))
                {
                    $renamedFile = $inputPassportScan->getRandomName();
                    $fileType    = $inputPassportScan->getExtension();

                    $dataFile = [
                        'inputDemandId'   => $demandId,
                        'inputUploadedAt' => Time::now(),
                        'inputCreatedAt'  => Time::now(),
                        'inputUpdatedAt'  => Time::now(),
                        'inputFileType'   => $fileType, 
                        'inputFileName'   => $renamedFile,
                        'inputDocType'    => "Passeport",
                    ];

                    $inputPassportScan->move(WRITEPATH . 'uploads',$renamedFile);
                    $this->uploadModel->createUpload($dataFile);

                }

                if (!($inputTicketScan->hasMoved()))
                {
                    $renamedFile = $inputTicketScan->getRandomName();
                    $fileType    = $inputTicketScan->getExtension();

                    $dataFile = [
                        'inputDemandId'   => $demandId,
                        'inputUploadedAt' => Time::now(),
                        'inputCreatedAt'  => Time::now(),
                        'inputUpdatedAt'  => Time::now(),
                        'inputFileType'   => $fileType, 
                        'inputFileName'   => $renamedFile,
                        'inputDocType'    => "Titre de Voyage",
                    ];
                    
                    $inputTicketScan->move(WRITEPATH . 'uploads',$renamedFile);
                    $this->uploadModel->createUpload($dataFile);
                }

                $filesUploaded = 0;
 
                // dd($this->request->getFileMultiple('inputOtherScan'));

                if($this->request->getFileMultiple('inputOtherScan'))
                {
                    $files = $this->request->getFileMultiple('inputOtherScan');
                    // dd($files);

                    foreach ($files as $file) {
         
                        if ($file->isValid() && ! $file->hasMoved())
                        {
                            $newName = $file->getRandomName();
                            $file->move(WRITEPATH.'uploads', $newName);
                            $data = [
                                'inputDemandId'   => $demandId,
                                'inputUploadedAt' => Time::now(),
                                'inputCreatedAt'  => Time::now(),
                                'inputUpdatedAt'  => Time::now(),
                                'inputFileType'   => $file->getClientExtension(), 
                                'inputFileName'   => $newName,
                                'inputDocType'    => "Autres documents".($filesUploaded+1),
                            ];

                            $this->uploadModel->createUpload($data);
                            $filesUploaded++;
                        }
                         
                    }
                }

                $note = $this->newDemanduserNote($user['username']);

                if($note == true)
                {
					$mail = 'cedrick-marc.mandahylla@creditducongo.com';
					$mail2 = 'en.mouhcine@gmail.com';
                    session()->setFlashdata('notif_success', '<b>Votre demande a été enregistré avec succès !</b> Un mail vous a été notifié.');    
                    $this->newDemandBankermail($user,$mail);
                    return redirect()->to(base_url('demands'));                 
                }
                elseif(!empty($note))
                {
                    session()->setFlashdata('notif_error', '<b>Une erreur a été constaté : </b>'.$note.' !<br /> Veuillez contacter un administrateur');
                }
            }                      
            session()->setFlashdata('notif_error', '<b>Une erreur a été constaté à Votre demande</b> Veillez recommencer !');
            return view('customer/demandAdd',$data);
        }
    }               
                
// Update
   
    public function updateForm($id)
    {
        $user   = $this->userModel->getUser(username: session()->get('username'));
        $demand = null;
        if($user['role_name'] === 'Client'){
            $demands =  $this->demandModel->getUserDemands($user['userID']);

            foreach($demands as $row){

                if(($row['demandID'] === $id) AND ($row['created_by'] === $user['userID'])) $demand = $row;                     
            }
            
            if($demand == null) return redirect()->to(base_url(''));

            $data = array_merge($this->data, [
                'title'     => 'Demande de dotation de Devises de la carte bancaire',
                'demand'    => $demand,
                'uploads'   => $this->uploadModel->getDemandUps($id),
                'status'    => $this->statusModel->getStatus(),
                'formulas'  => $this->const->loadFormula(),
                'purposes'  => $this->const->loadPurpose(),
                'bc_types'  => $this->const->loadBcType(),
                'countries' => $this->countryModel->getNoCemacCountries()
            ]);
            return view('customer/demandUpdate', $data);
        }
        return redirect()->to(base_url(''));                
    }
   
    public function updateDemands()
    {
        $user   = $this->userModel->getUser(username: session()->get('username'));        
        $id     = $this->request->getVar('demandId', FILTER_UNSAFE_RAW);  
        // dd($id);      
        $demand = $this->demandModel->getdemands($id);        

        if ($this->data['subsegment'] === 'status') {
            
            $inputStatus  = htmlspecialchars($this->request->getVar('inputStatus', FILTER_UNSAFE_RAW));
            $status       = $this->statusModel->getStatus($inputStatus);

            $status_date  = (!empty($inputStatus)? date('Y-m-d H:i:s') : $demand['status_date']);
            $inputComment = (!empty($demand['comment'])? $demand['comment']:'');

            if(intval($status['st_order'])  === 2)
            {
                $validate = [
                    'inputComment' => [
                        'label' => 'Les Raisons du refus', 
                        'rules' => 'required',
                        'error' => 'Le champ commentaire ne peut-être vide' 
                    ]
                ];

                if(!$this->validate($validate))
                {
                    session()->setFlashdata('notif_error', $this->validation->getError('inputComment'));
                    return redirect()->to(base_url('demands')); 
                }
                else
                {
                    $inputComment = htmlspecialchars($this->request->getVar('inputComment', FILTER_UNSAFE_RAW));
                }
            }
                
            $dataDemand  = [
                'inputDemandsID'    => $id,
                'inputComment'      => $inputComment,
                'inputStatus'       => $inputStatus,
                'inputStatusDate'   => $status_date,
                'inputModifiedBy'   => $user['userID'],
            ];

            $updateDemands = $this->demandModel->updateDemandStatus($dataDemand);

            if ($updateDemands) {
                // dd($demand['created_by']);
                $customer = $this->userModel->getUser(userID:$demand['created_by']);
                // dd($customer);
                $send = $this->suspendDemanduserNote($demand, $customer['username']);
                if(!$send) return 
                
                session()->setFlashdata('notif_success', '<b>Demande modifiée avec succès !</b>');
                return redirect()->to(base_url('demands'));
            }

            return view('customer/demandList');
        }
        // Todo : insérer la validation des erreurs dans un tableau et la gestion des erreurs dans un tableau pour indiquer les erreurs en français
        
        $validate = [
            'inputDobt'         => [
                'label' => 'Date Début Voyage', 
                'rules' => 'valid_date',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            'inputDoet'         => [
                'label' => 'Date Fin Voyage', 
                'rules' => 'valid_date',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            'inputBcnum'        => [
                'label' => 'Numéro carte Bancaire', 
                'rules' => 'numeric|digitCheck',
                'errors' => [
                    'required'   => 'le champ est obligatoire',
                    'digitCheck' => 'Vous devez entrer 4 chiffres obligatoirement'
                ]
            ],
            'inputCountry'      => [
                'label' => 'Pays', 
                'rules' => 'required',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
            'inputPasspNum'     => [
                'label' => 'N° Passeport', 
                'rules' => 'required|alpha_numeric|is_unique[demands.passport_num]',
                'errors' => [
                    'required'  => 'le champ est obligatoire',
                    'is_unique' => 'Ce numéro de passeport existe déjà',
                ]
            ],
			'inputDov'    		=> [
                'label' => 'Valable jusqu\'au', 
                'rules' => 'required',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],
			'inputBcDov'    	=> [
                'label' => 'Valable jusqu\'au', 
                'rules' => 'required',
                'errors' => [
                    'required'=> 'le champ est obligatoire'
                ]
            ],                     
        ];

        if (!$this->validate( $validate))
        {              
            $dobtError = (!empty($this->validation->getError('inputDobt'))? $this->validation->getError('inputDobt').'<br/>': '');
            $doetError = (!empty($this->validation->getError('inputDoet'))? $this->validation->getError('inputDoet').'<br/>': '');
            $bcnumError = (!empty($this->validation->getError('inputBcnum'))? $this->validation->getError('inputBcnum').'<br/>': '');
            $countryError = (!empty($this->validation->getError('inputCountry'))? $this->validation->getError('inputCountry').'<br/>': '');
            $passpNumError = (!empty($this->validation->getError('inputPasspNum'))? $this->validation->getError('inputPasspNum').'<br/>': '');
            $dovError = (!empty($this->validation->getError('inputDov'))? $this->validation->getError('inputDov').'<br/>': '');
            $visaScanError = (!empty($this->validation->getError('inputVisaScan'))? $this->validation->getError('inputVisaScan').'<br/>': '');
            $passportScanError = (!empty($this->validation->getError('inputPassportScan'))? $this->validation->getError('inputPassportScan').'<br/>': '');
            $ticketScanError = (!empty($this->validation->getError('inputTicketScan'))? $this->validation->getError('inputTicketScan').'<br/>': '');
            session()->setFlashdata('notif_error',  $dobtError.$doetError.$bcnumError.$countryError.$passpNumError.$dovError
                                                    .$visaScanError.$passportScanError.$ticketScanError);   
                                                            
            return redirect()->to(base_url('demand/update/'.$id));
        }
        else
        {   
            $inputDobt          = htmlspecialchars($this->request->getVar('inputDobt', FILTER_UNSAFE_RAW));
            $inputDoet          = htmlspecialchars($this->request->getVar('inputDoet', FILTER_UNSAFE_RAW));
            $inputCountry       = htmlspecialchars($this->request->getVar('inputCountry', FILTER_UNSAFE_RAW));
            $inputPasspNum      = htmlspecialchars($this->request->getVar('inputPasspNum', FILTER_UNSAFE_RAW));
            $inputDov           = htmlspecialchars($this->request->getVar('inputDov', FILTER_UNSAFE_RAW));
            $inputBcType        = htmlspecialchars($this->request->getVar('inputBcType', FILTER_UNSAFE_RAW));
            $inputBcnum         = htmlspecialchars($this->request->getVar('inputBcnum', FILTER_UNSAFE_RAW));
            $inputBcDov         = htmlspecialchars($this->request->getVar('inputBcDov', FILTER_UNSAFE_RAW));
            $inputBcForm        = htmlspecialchars($this->request->getVar('inputBcForm', FILTER_UNSAFE_RAW));            
            $inputStP           = htmlspecialchars($this->request->getVar('inputStP', FILTER_UNSAFE_RAW));

            $dataDemand  = [
                'inputDemandsID'    => $id,
                'inputDobt'         => $inputDobt,
                'inputDoet'         => $inputDoet,
                'inputPasspNum'     => $inputPasspNum,
                'inputDov'          => $inputDov,
                'inputBcForm'       => $inputBcForm,
                'inputBcType'       => $inputBcType,
                'inputBcnum'        => $inputBcnum,
                'inputBcDov'        => $inputBcDov,
                'inputDestination'  => $inputCountry,
                'inputStP'          => $inputStP,
                'inputModifiedBy'   => $user['userID'],
            ];

            $demand  = $this->demandModel->updateDemands($dataDemand) ; 

            if ($demand) {
				$mail = 'cedrick-marc.mandahylla@creditducongo.com';
				$mail2 = 'en.mouhcine@gmail.com';
                session()->setFlashdata('notif_success', '<b>Votre demande a été modifié avec succès !</b>.');    
                $this->suspendDemandBankermail($user,$mail);
                return redirect()->to(base_url('demands'));               
            }                   
        }
        return redirect()->to(base_url('demand/update/'.$id));
    }
          
	// Cancel
                
    public function cancelDemands($demandID)
    {
		$user   = $this->userModel->getUser(username: session()->get('username'));
        if (!$demandID) {
			session()->setFlashdata('notif_error', '<b>Cette demande n\'existe pas !</b>');
            return redirect()->to(base_url('demands'));
        }
		$dataDemand  = [
                'inputDemandsID'   => $demandID,                
                'inputStatus'      => 2,
                'inputStatusDate'  => Time::now(),
                'inputModifiedBy'  => $user['userID'],
			];			
        $canceledDemands = $this->demandModel->cancelDemands($dataDemand);
        if ($canceledDemands) {
            session()->setFlashdata('notif_success', '<b>Demande annulée avec succès !</b>');
            return redirect()->to(base_url('demands'));
        } else {
            session()->setFlashdata('notif_error', '<b>Une erreur est survenue lors de l\'annulation</b>');
            return redirect()->to(base_url('demands'));
        }
    } 
	
 // Delete
                
    public function deleteDemands($demandID)
    {
        if (!$demandID) {
            return redirect()->to(base_url('demands'));
        }
        $deleteDemands = $this->demandModel->deleteDemands($demandID);
        if ($deleteDemands) {
            session()->setFlashdata('notif_success', '<b>Demande annulée avec succès !</b>');
            return redirect()->to(base_url('demands'));
        } else {
            session()->setFlashdata('notif_error', '<b>Une erreur est survenue lors de l\'annualtion</b>');
            return redirect()->to(base_url('demands'));
        }
    } 

    function excelExport()
    {
        // $employee_object = new EmployeeModel();

        $demands = $this->demandModel->getUserDemands();

        $file_name = 'Liste_demandes.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Client');

        $sheet->setCellValue('B1', 'Date Début Voyage');

        $sheet->setCellValue('C1', 'Date fin de voyage');

        $sheet->setCellValue('D1', 'Lieu de Destination');

        $sheet->setCellValue('E1', 'Etat');

        $count = 2;

        foreach($demands as $row)
        {
            $sheet->setCellValue('A' . $count, $row['fullname']);

            $sheet->setCellValue('B' . $count, $row['dobt']);

            $sheet->setCellValue('C' . $count, $row['doet']);

            $sheet->setCellValue('D' . $count, $row['destination']);

            $sheet->setCellValue('E' . $count, $row['status']);

            $count++;
        }

        $writer = new Xlsx($spreadsheet);

        $writer->save($file_name);

        header("Content-Type: application/vnd.ms-excel");

        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length:' . filesize($file_name));

        flush();

        readfile($file_name);

        exit;
    } 
    
    function pdfExport($demandId)
    {
        $demand    = $this->demandModel->getDemands($demandId);
        $applicant = $this->userModel->getUser(userID: $demand['created_by']);
        $b_account = $this->bankAccountModel->getUserBankAccounts($applicant['userID']);
        
        $data = array_merge($this->data, [
            'title'     => 'Demande de dotation de Devises de la carte bancaire',
            'demand'    => $demand,
            'applicant' => $applicant,
            'account'   => $b_account
        ]);

        $html = "<h1>PDF Example</h1>";
        $this->domPdf->set_option('isHtml5ParserEnabled', true);
        $this->domPdf->loadHTML(view('banker/demandpdfvue',$data));
        $this->domPdf->setPaper('A4','portrait');
        $this->domPdf->render();
        $this->domPdf->stream('formulaire de demande', array("Attachment" => false));
    }
    // 1- mail à envoyer au client à l'état demande reçue
    private function newDemanduserNote($inputEmail){

        $mail = $this->mail->load();

        $subject = 'Demande de dotation de devise';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de devise</title>
                    </head>
                    <body>
                        <h2>DEMANDE DE DOTATION DE DEVISE</h2>
                        <p>Bonjour Monsieur, Madame votre demande a bien été transmise.<br/>
                           Vous recevrez un mail à chaque évolution de votre demande.<br/>
                           Ou vous pouvez accéder à la plateforme pour suivre L'état de votre demande</p>
                        <p>Cordialement. </p>                        
                        <h4><a href='".base_url()."'>Suivre ma demande</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Noreply@creditducongo.com', 'Dotation de Devises');
        $mail->AddAddress($inputEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

        //Envoi de l'email
        if($mail->send())
        {
           return true;
        }
        else
        {
            return $mail->ErrorInfo;
        }
    } 
    // 1- mail à envoyer à la banque à l'état demande reçue
    private function newDemandBankermail($data,$sendEmail)
    {
        $mail = $this->mail->load();

        $subject = 'Dotation de devises';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de Devises</title>
                    </head>
                    <body>
                        <h2>NOUVELLE DEMANDE DE DOTATION DE DEVISE</h2>
                        <p>Un client vient de lancer une nouvelle demande de Dotation de devises pour sa carte, il s'agit de :</p>
                        <p>Nom : ".$data['fullname']."</p>
                        <p>Email : ".$data['username']."</p>
                        <p>Veuillez clicker sur le lien suivant pour accéder à la plateforme :</p>
                        <h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Alerte@creditducongo.com', 'Dotation de Devises');
        $mail->AddAddress($sendEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

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

    // 2- mail à envoyer au client à l'état demande annulée
    private function cancelDemanduserNote($inputEmail){

        $mail = $this->mail->load();

        $subject = 'Annulation Demande de dotation de devise';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de devise</title>
                    </head>
                    <body>
                        <h2>ANNULATION DE VOTRE DEMANDE</h2>
                        <p>Bonjour Monsieur, Madame vous venez de confirmer l’annulation de votre demande.<br/>
                            Sachez que cette requête est irréversible.<br/>
                            Cependant si vous le souhaitez, vous pouvez accéder à la plateforme pour établir une nouvelle demande</p>
                        <p>Cordialement. </p>                        
                        <h4><a href='".base_url()."'>J’ouvre une nouvelle demande</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Noreply@creditducongo.com', 'Annulation de Dotation de Devises');
        $mail->AddAddress($inputEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

        //Envoi de l'email
        if($mail->send())
        {
        return true;
        }
        else
        {
            return $mail->ErrorInfo;
        }
    } 
    // 2- mail à envoyer à la banque à l'état demande annulée par le client
    private function cancelDemandBankermail($data,$sendEmail)
    {
        $mail = $this->mail->load();

        $subject = 'Dotation de devises';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de Devises</title>
                    </head>
                    <body>
                        <h2>ANNULATION D'UNE DEMANDE</h2>
                        <p>Un client vient de confirmer l'annulataion de sa demande de Dotation de devises pour sa carte, il s'agit de :</p>
                        <p>Nom : ".$data['fullname']."</p>
                        <p>Email : ".$data['username']."</p>
                        <p>Veuillez clicker sur le lien suivant pour accéder à la plateforme :</p>
                        <h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Alerte@creditducongo.com', 'Dotation de Devises');
        $mail->AddAddress($sendEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

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

    // 3- mail à envoyer au client à l'état demande en cours de traitement par la banque
    private function processingDemanduserNote($inputEmail){

        $mail = $this->mail->load();

        $subject = 'Demande de dotation de devise';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de devise</title>
                    </head>
                    <body>
                        <h2>DEMANDE EN COURS DE TRAITEMENT</h2>
                        <p>Bonjour Monsieur, Madame nous vous indiquons que votre demande est passé en traitement.<br/>
                            Nos agents analyse votre dossier, vous recevrez une nouvelle notification dans les plus brefs delais.<br/>
                            Cependant si vous souhaitez, vous pouvez accéder à la plateforme pour suivre directement votre demande</p>
                        <p>Cordialement. </p>                        
                        <p>Veuillez clicker sur le lien suivant pour accéder à la plateforme :</p>
                        <h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Noreply@creditducongo.com', 'Annulation de Dotation de Devises');
        $mail->AddAddress($inputEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

        //Envoi de l'email
        if($mail->send())
        {
        return true;
        }
        else
        {
            return $mail->ErrorInfo;
        }
    } 
    // 3- mail à envoyer à la banque à l'état demande en cours de traitement par le client
    private function processingDemandBankermail($data,$sendEmail)
    {
        $mail = $this->mail->load();

        $subject = 'Dotation de devises en cours de traitement';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de Devises</title>
                    </head>
                    <body>
                        <h2>DEMANDE EN COURS DE TRAITEMENT</h2>
                        <p> Vous venez de changer le statut de la demande d'un client, qui passe en traitement, il s'agit de :</p>
                        <p>Nom : ".$data['fullname']."</p>
                        <p>Email : ".$data['username']."</p>
                        <p>Veuillez clicker sur le lien suivant pour accéder à la plateforme pour d'autres modification :</p>
                        <h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Alerte@creditducongo.com', 'Dotation de Devises');
        $mail->AddAddress($sendEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

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
    // 4- mail à envoyer au client à l'état de demande en attente de complément.
    private function suspendDemanduserNote($demand,$inputEmail){        
        $status = null;
        $comment = '';
        if(!empty($demand))
        {
            $status = $this->statusModel->getStatus($demand['status_id']);

            if($status['st_order'] ==="3")
            $comment = 'Les raisons ce status :'.$demand['comment'].'<br/>';
        }
        

        $mail = $this->mail->load();

        $subject = 'Demande de dotation de Devises';
        $message =  "
                    <html>
                    <head>
                        <title>Changement de Statut</title>
                    </head>
                    <body>
                        <h2>DEMANDE EN ATTENTE DE COMPLEMENT DE DOCUMENTS</h2>
                        <p>Bonjour Monsieur votre demande a changé de statut.<br/>
                           Votre demande est : en attente de complément de documents<br/>
                           il manque les documents suivants :
                           ".$comment."<br/>
                           Ces documents sont nécessaires pour la suite du traitement de votre demande,
                           veuillez mettre à jour au plus tôt les documents manquants sur la plateforme.<br/>
                           Vous recevrez un mail à chaque évolution de votre demande.<br/>
                           Ou vous pouvez allez sur la plateforme pour suivre L'état de votre demande</p>
                        <p>Cordialement. </p>                        
                        <h4><a href='".base_url()."'>Suivre ma demande</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Noreply@creditducongo.com', 'Dotation de Devises');
        $mail->AddAddress($inputEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

        //Envoi de l'email
        if($mail->send())
        {
           return true;
        }
        else
        {
            return $mail->ErrorInfo;
        }
    }
    // 4- mail à envoyer à la banque à l'état de demande en attente de complément.
    private function suspendDemandBankermail($data,$sendEmail)
    {
        $mail = $this->mail->load();

        $subject = 'Modification de la Demande de dotation en devise';
        $message =  "
                    <html>
                    <head>
                        <title>Modification Plafond</title>
                    </head>
                    <body>
                        <h2>DEMANDE EN ATTENTE DE COMPLEMENT DE DOCUMENTS</h2>
                        <p>Vous venez vient de modifier la demande de dotation en devise du client :</p>
                        <p>Nom : ".$data['fullname']."</p>
                        <p>Email : ".$data['username']."</p>
                        <p>Sa demande est en attente de compléments de documents.<br/>
                        Pour de nouvelles mises à jour,
                        veuillez clicker sur le lien suivant pour accéder à la plateforme :</p>
                        <h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Alerte@creditducongo.com', 'Dotation de Devise');
        $mail->AddAddress($sendEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

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

    // 5- mail à envoyer à la banque lorsqu'un client ajoute de nouveaux documents à l'état de demande en attente de complément.
    private function addDocDemandBankermail($data,$sendEmail)
    {
        $mail = $this->mail->load();

        $subject = 'Modification de la Demande de dotation en devise';
        $message =  "
                    <html>
                    <head>
                        <title>Modification Plafond</title>
                    </head>
                    <body>
                        <h2>AJOUT DE DOCUMENTS POUR LA DEMANDE</h2>
                        <p>Un client vient de modifier sa demande en y ajoutant des fichiers supplémentaires, il s'agit de :</p>
                        <p>Nom : ".$data['fullname']."</p>
                        <p>Email : ".$data['username']."</p>
                        <p>Veuillez clicker sur le lien suivant pour accéder à la plateforme afin de vérifier la conformité des documents :</p>
                        <h4><a href='".base_url()."'>Accéder à la plateforme</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Alerte@creditducongo.com', 'Dotation de Devise');
        $mail->AddAddress($sendEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

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

    // 6- mail à envoyer au client à l'état de demande validée.
    // 6- mail à envoyer à la banque à l'état de demande validée.
    // 7- mail à envoyer à la banque à l'état de demande validé cass d'un utilisateur qui rallonge sa date de retour.
    // 8- mail à envoyer au client à l'état de demande clôturé.
    // 8- mail à envoyer à la banque à l'état de demande clôturé.
    private function userStatusNote($inputEmail, $status = null, $statusOrder = null, $comment = null){

        $mail = $this->mail->load();

        if(!empty($statusOrder) AND $statusOrder == 2)
            $span = "<span> </span>";
        $subject = 'Modification de votre demande';
        $message =  "
                    <html>
                    <head>
                        <title>Demande de dotation de Devises</title>
                    </head>
                    <body>
                        <h2>ACTIVATION DE PLAFOND DE MA CARTE.</h2>
                        <p>Bonjour Monsieur / Madame votre demande est en traitement actuellement .<br/>
                           Elle a donc le statut de : .<br/>
                           Ou vous pouvez la plateforme pour suivre L'état de votre demande</p>
                        <p>Cordialement. </p>                        
                        <h4><a href='".base_url()."'>Suivre ma demande</a></h4>
                    </body>
                    </html>
                    ";
        $mail->SetFrom('Noreply@creditducongo.com', 'Dotation de Devises');
        $mail->AddAddress($inputEmail);
        $mail->Subject  = $subject;
        $mail->Body     = $message;

        //Envoi de l'email
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