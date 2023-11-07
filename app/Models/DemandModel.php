<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Builder\Function_;

class DemandModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'demands';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                        'dobt', 
                        'doet',
                        'bc_type', 
                        'bcnum',
                        'bcdov', 
                        'destination', 
                        'comment', 
                        'visa_scan', 
                        'passport_scan', 
                        'ticket_scan', 
                        'status_id', 
                        'status_date',
                        'created_by'
                ];

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

    // Read function                
    public function getDemands($DemandsID = false)
    {
        if ($DemandsID) {
            return $this->db->table('demands')
            ->where(['demands.id' => $DemandsID])
            ->get()->getRowArray();
        } else {
            return $this->db->table('demands')
            ->get()->getResultArray();
        }
    }

    // Sort by status
    public function getDemandsByStatus($order = false)
    {
        if ($order) {
            return $this->db->table('demands')
            ->join('status', 'demands.status_id = status.id')
            ->where(['status.st_order' => $order])
            ->get()->getResultArray();
        } else {
            return $this->db->table('demands')
            ->get()->getResultArray();
        }
    }
    // Read function for user

    public function getUserDemands($userId = false)
    {
        if ($userId) {
            return $this->db->table('demands')
                ->select(
                    '*,
                    demands.id AS demandID,
                    demands.created_at AS doc,
                    status.status AS status,
                    status.st_order AS statusOrder,
                    bank_accounts.acc_num AS bankAccount'
                )
                ->join('users', 'demands.created_by = users.id')
                ->join('bank_accounts', ' bank_accounts.id_user = users.id')
                ->join('status', 'demands.status_id = status.id')
                ->where(['created_by' => $userId])
                ->orderBy('demands.created_at','Desc')                 
                ->orderBy('statusOrder','Desc')                               
                ->get()->getResultArray();
        } else {
            return $this->db->table('demands')
                ->select(
                    '*,
                    demands.id AS demandID,
                    demands.created_at AS doc,
                    status.status AS status,
                    status.st_order AS statusOrder,
                    bank_accounts.acc_num AS bankAccount'
                )
                ->join('users', 'demands.created_by = users.id')
                ->join('bank_accounts', ' bank_accounts.id_user = users.id')
                ->join('status', 'demands.status_id = status.id')
                ->orderBy('demands.created_at','Desc')
                ->orderBy('statusOrder','Desc')                
                ->get()->getResultArray();
        }
    }

    // Insert
                
    public function createDemands($dataDemands)
    {
        return $this->db->table('demands')->insert([  
            'dobt'            => $dataDemands['inputDobt'],
            'doet'            => $dataDemands['inputDoet'],
            'bc_type'         => $dataDemands['inputBcType'],
            'bcnum'           => $dataDemands['inputBcnum'],
            'bcdov'           => $dataDemands['inputBcDov'],
            'bc_formula'      => $dataDemands['inputBcForm'],
            'destination'     => $dataDemands['inputDestination'],
            'stay_purpose'    => $dataDemands['inputStP'],
            'passport_num'    => $dataDemands['inputPasspNum'],
            'passport_date'   => $dataDemands['inputDov'],
            'status_id'       => $dataDemands['inputStatus'],
            'created_at'      => $dataDemands['inputCreatedAt'],
            'created_by'      => $dataDemands['inputCreatedBy'],
            'modified_by'     => $dataDemands['inputModifiedBy'],
        ]);
    }

    public function getLastInsertID()
	{
		return $this->db->insertID();
	}

    // Update
                
    public function updateDemands($dataDemands)
    {
        return $this->db->table('demands')->update([
            'dobt'            => $dataDemands['inputDobt'],
            'doet'            => $dataDemands['inputDoet'],
            'bc_type'         => $dataDemands['inputBcType'],
            'bcnum'           => $dataDemands['inputBcnum'],
            'bcdov'           => $dataDemands['inputBcDov'],
            'bc_formula'      => $dataDemands['inputBcForm'],
            'destination'     => $dataDemands['inputDestination'],
            'stay_purpose'    => $dataDemands['inputStP'],
            'passport_num'    => $dataDemands['inputPasspNum'],
            'passport_date'   => $dataDemands['inputDov'],
            'modified_by'     => $dataDemands['inputModifiedBy'],
        ], ['id' => $dataDemands['inputDemandsID']]);
    }
        
    // Update status of the demand
                
    public function updateDemandStatus($dataDemands)
    {
        // dd($dataDemands['inputStatus']);
        return $this->db->table('demands')->update([        
                    
            'status_id'       => $dataDemands['inputStatus'],
            'status_date'     => $dataDemands['inputStatusDate'],
            'comment'         => $dataDemands['inputComment'], 
            'modified_by'     => $dataDemands['inputModifiedBy'],
        ], ['id' => $dataDemands['inputDemandsID']]);
    }
	// Cancel demand
	public function cancelDemands($dataDemands)
    {
        return $this->db->table('demands')->update([        
                    
            'status_id'       => $dataDemands['inputStatus'],
            'status_date'     => $dataDemands['inputStatusDate'],
            'modified_by'     => $dataDemands['inputModifiedBy'],
        ], ['id' => $dataDemands['inputDemandsID']]);
    }

    // Delete         

    public function deleteDemands($DemandsID)
    {
        return $this->db->table('demands')->delete(['id' => $DemandsID]);
    }

    public function checkLastValidDemand($user_id)
    {
        $demand    = $this->db->table('demands')->where(['created_by' => $user_id])->orderBy('id','DESC')->get()->getRowArray();
        
        if (isset($demand) AND (($demand['status_id'] != 1) OR ($demand['status_id'] != 5))) return $demand;

        return false;
    }

    public function updateDom($dataDemands)
    {
        return $this->db->table('demands')->update([      
                    
            'bcdom' => $dataDemands['dom'],
        ], ['id' => $dataDemands['id']]);
    }
}
