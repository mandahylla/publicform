<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use Exception;

class UploadFile extends BaseController
{
    function index()
    { 
        $data = []; 
         
        // Get files data from the database 
        $data['files'] = $this->uploadModel->getRows(); 
         
        // Pass the files data to view 
        return view('upload_file/index', $data); 
    } 

    // ajouter un fichier dans la base de données et l'upload 
    function createFiles()
    { 
        $data   = [];
        $user   = $this->userModel->getUser(username: session()->get('username'));        
        $id     = $this->request->getVar('demandId', FILTER_UNSAFE_RAW);   
        $demand = $this->demandModel->getdemands($id);
        $inputDocType = htmlspecialchars($this->request->getVar('inputDocType', FILTER_UNSAFE_RAW));
        
        $rules = [
            'inputFile' => [
                 'rules'  => 'uploaded[inputFile]|ext_in[inputFile,jpg,jpeg,png,pdf]|max_size[inputFile,2048]',
                 'errors' => [
                    'uploaded' => 'Le fichier n\'est pas valide', 
                    'ext_in'   => 'Le fichier doit-être une image ou un document pdf',
                    'max_size' => 'la taille du fichier ne doit pas être supérieur à 2Mo'                    
                    ]
                ],
        ];

        if ($inputDocType == 5) {
            $rules = array_merge($rules, [
                 'inputOtherName' => [
                  'rules'  => 'required',
                  'errors' => [
                     'required' => 'Vous devez remplir ce champ'                    
                    ]
                 ],
            ]);
        }

        if (!$this->validate($rules)) {
            $data = array_merge($this->data, [
                'title'    => 'Augmentation de Plafond de la carte bancaire',
                'demand'   => $demand
            ]);

            session()->setFlashdata('notif_error', $this->validation->getError('inputFile'));
            return redirect()->to(base_url('demand/update/'.$id));
        }
        else
        {
            $demandId     = htmlspecialchars($this->request->getVar('demandId', FILTER_UNSAFE_RAW));            
            $inputFile    = $this->request->getFile('inputFile');
            switch ($inputDocType) {
                case '1':
                    $inputDocType   = "Passeport";
                    break;
                case '2':
                    $inputDocType   = "Visa ou équivalent";
                    break;
                case '3':
                    $inputDocType   = "Titre de Voyage";
                    break;
                case '4':
                    $inputDocType   = "Image cachet d'entrée";
                    break;
                case '5':
                    $inputDocType   = htmlspecialchars($this->request->getVar('inputOtherName', FILTER_UNSAFE_RAW));
                    break;    
                // default:
                //     # code...
                //     break;
            }

            if (!$inputFile->hasMoved()) {
                
                $renamedFile = $inputFile->getRandomName();
                $fileType    =  $inputFile->getExtension();
                $inputFile->move(WRITEPATH . 'uploads',$renamedFile);

                // enregistrement dans la bd des infos liées au fichier
                $dataFile = [
                    'inputDemandId'   => $id,
                    'inputUploadedAt' => Time::now(),
                    'inputCreatedAt'  => Time::now(),
                    'inputUpdatedAt'  => Time::now(),
                    'inputFileType'   => $fileType, 
                    'inputFileName'   => $renamedFile,
                    'inputDocType'    => $inputDocType,
                ];
                $this->uploadModel->createUpload($dataFile);
                session()->setFlashdata('notif_success', 'Fichier enregistré avec succès !');
            }
            else
            {
                session()->setFlashdata('notif_error', 'une erreur est survenue lors du téléchargement veuillez contacter l\'administrateur du site');                
            }
        }          
        return redirect()->to(base_url('demand/update/'.$id));
    } 

    public function ajaxListFiles(){

        // echo 'here is ajax !'; exit;
        $demandId = $this->request->getVar('demand_id', FILTER_UNSAFE_RAW);

        if(!empty($demandId)){

            $filesList = $this->uploadModel->getRows(demand_id:$demandId);

            if(!empty($filesList)){
                $list_str= '<ul class="list-group">';
                $counter = 1;
                foreach($filesList as $row)
                {
                    $list_str.='<li class="mb-2 list-group-item">';
                    $list_str.='<span>'.$row['doc_type'].'</span> |';
                    $list_str.='<a href="'. base_url('assets/uploads/'.$row['file_name']).'" class="btn btn-primary btn-sm float-end" target=”_blank”>lien du document</a>';
                    $list_str.='</li>';  
                    $counter++; 
                }
                $list_str.= '</ul>';
                echo $list_str;
            }
            else{
                echo 0;
            }
            /* return $this->response->setContentType('application/json')                             
                                  ->setStatusCode(200)
                                  ->setJSON($fileList); */ 
        }
        //Todo: la méthode qui permetra de renvoyer la liste des fichiers selon l'id de la demande choisie.
    }

    public function displayFile($fileName)
    {
        // Récupérer le chemin du fichier depuis la base de données
        $fileModel = $this->uploadModel;// Assurez-vous d'avoir un modèle pour gérer les fichiers
        $fileData  = $fileModel->where('file_name', $fileName)->first();

        if (!$fileData) {
            // Gérer le cas où le fichier n'existe pas
            session()->setFlashdata('notif_error', 'Désolé le fichier sélectionné n\'existe pas !'); 
            return redirect()->to(site_url());
        }

        // Construire le chemin complet du fichier
        $filePath = WRITEPATH . 'uploads/' . $fileData['file_name'];

        // Vérifier si le fichier existe
        if (is_file($filePath)) {
            // Afficher le fichier dans un nouvel onglet
            header("Content-Type: " . $fileData['file_type']);
            header("Content-Disposition: inline; filename=\"" . $fileData['file_name'] . "\"");
            readfile($filePath);
        } else {
            // Gérer le cas où le fichier n'existe pas
            session()->setFlashdata('notif_error', 'une erreur est survenue lors du téléchargement il possible que le fichier soit corrompu veuillez contacter l\'administrateur du site');   
            return redirect()->to(site_url());
        }
    }
    
    // Delete
                
    public function deleteFiles($uploadID)
    {        
        // $uploadID = $this->request->getVar('id',FILTER_UNSAFE_RAW);

        if (!$uploadID) {
            
            echo 'erreur !';
        }        
        $uploadFile   = $this->uploadModel->getRows($uploadID);  
        $deleteUpload = $this->uploadModel->deleteUploads($uploadID);
        if ($deleteUpload) {
            unlink(WRITEPATH . 'uploads/'.$uploadFile['file_name']);
            session()->setFlashdata('notif_success', '<b>Fichier supprimé</b>');
            return redirect()->to(base_url('demand/upload/'.$uploadFile['demand_id']));
        } else {
            session()->setFlashdata('notif_error', '<b>Failed to delete Demands</b>');
            return redirect()->to(base_url('demands'));
        }
    } 

    // Delete via Ajax
                
    public function ajaxDeleteFiles()
    {        
        $uploadID = $this->request->getVar('id',FILTER_UNSAFE_RAW);
        
        if (!$uploadID) {
            echo 'No id found';
        }
        else
        {   
            try {
                $uploadFile   = $this->uploadModel->getRows($uploadID); 
                $deleteUpload = $this->uploadModel->deleteUpload($uploadID);
                if ($deleteUpload) {
                    unlink(WRITEPATH . 'uploads'.'\\'.$uploadFile['file_name']);
                    echo 1;
                } else {
                    echo 0;
                }
            }catch(Exception $ex) {
                print_r($ex); exit;                
            }          
            
        } 
        
    } 
}
