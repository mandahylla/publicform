<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadFileModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'file_uploads';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['demand_id', 'doc_type', 'file_type', 'file_name', 'uploaded_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

        /* 
     * Fetch files data from the database 
     * @param id returns a single record if specified, otherwise all records 
     */ 
    public function getRows($id = null, $demand_id = null){ 
        
        if($id){ 
            $result = $this->db->table('file_uploads')
                            ->select('id, demand_id, doc_type, file_type, file_name, uploaded_at')
                            ->where(['id'=>$id])
                            ->get()->getRowArray(); 
        }elseif($demand_id){ 
            $result = $this->table('file_uploads')
                               ->select('id, demand_id, doc_type, file_name, file_name, uploaded_at')
                               ->where(['demand_id'=>$demand_id])
                               ->get()->getResultArray(); 
        }else{
            $result = $this->table('file_uploads')
                            ->select('id, demand_id, doc_type, file_type, file_name, uploaded_at')
                            ->order_by('uploaded_at','desc')
                            ->get()->getResultArray(); 
        } 
         
        return !empty($result)?$result:false; 
    } 
     
    /* 
     * Fetch files data attached to a demand from the database 
     * @param demand_id returns specified demand attached files 
     */ 
    public function getDemandUps($demand_id = null){ 
        
        if($demand_id){ 
            $result = $this->db->table('file_uploads')
                               ->select('id, demand_id, doc_type, file_name, file_name, uploaded_at')
                               ->where(['demand_id'=>$demand_id])
                               ->get()->getResultArray(); 
        }else{
            $result = $this->table('file_uploads')
                           ->select('id, demand_id, doc_type, file_type, file_name, uploaded_at')
                           ->order_by('uploaded_at','desc')
                           ->get()->getResultArray(); 
        } 
         
        return !empty($result)?$result:false; 
    } 

    /* 
     * Insert file data into the database 
     * @param array the data for inserting into the table 
     */
    public function createUpload($data)
    {
        $insert = [
            'demand_id'   => $data['inputDemandId'],
            'doc_type'    => $data['inputDocType'],
            'file_type'   => $data['inputFileType'],
            'file_name'   => $data['inputFileName'],
            'uploaded_at' => $data['inputUploadedAt'],
            'created_at'  => $data['inputCreatedAt'],
            'updated_at'  => $data['inputUpdatedAt']
        ];

        return $this->db->table('file_uploads')->insert($insert);
    }

    /* 
     * Insert file data into the database 
     * @param array the data for inserting into the table 
     */
    public function updateUpload($data)
    {
        $update = [
            'demand_id'   => $data['inputDemandId'],
            'doc_type'    => $data['inputDocType'],
            'file_name'   => $data['inputFileName'],
            'uploaded_at' => $data['inputUploadedAt'],
            'created_at'  => $data['inputCreatedAt'],
            'uptaded_at'  => $data['inputUptadedAt']
        ];
        return $this->db->table('file_uploads')->update($update, ['id' => $data['inputID']]);
    } 

    // Delete         

    public function deleteUpload($uploadID)
    {
        return $this->db->table('file_uploads')->delete(['id' => $uploadID]);
    }
}
