<?php

namespace App\Models;

use CodeIgniter\Model;

class BankAccountModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bank_accounts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user','acc_num'];

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

    public function getBankAccounts($BankAccountsID = false, $BankAccounts = false)
    {
        if ($BankAccountsID) {
            return $this->db->table('bank_accounts')
            ->where(['bank_accounts.id' => $BankAccountsID])
            ->get()->getRowArray();
        } else if ($BankAccounts) {
            return $this->db->table('bank_accounts')
            ->where(['bank_accounts.acc_num' => $BankAccounts])
            ->get()->getRowArray();
        } else {
            return $this->db->table('bank_accounts')
            ->get()->getResultArray();
        }
    }

    public function getUserBankAccounts($userID = false)
    {
        if ($userID) {
            return $this->db->table('bank_accounts')
            ->where(['bank_accounts.id_user' => $userID])
            ->get()->getRowArray();
        } else {
            return $this->db->table('bank_accounts')
            ->get()->getResultArray();
        }
    }

    public function createBankAccount($dataBankAccounts)
    {        
        return $this->db->table('bank_accounts')->insert([        
          'id_user'         => $dataBankAccounts['inputIdUser'],
          'acc_num'         => $dataBankAccounts['inputAccNum'], 
        ]);
        // printf($dataBankAccounts['inputAccNum']); exit();
    }


    public function updateBankAccount($dataBankAccounts)
    {
        return $this->db->table('bank_accounts')->update([

          'id_user'         => $dataBankAccounts['inputIdUser'],
          'acc_num'         => $dataBankAccounts['inputAccNum'],

        ], ['id' => $dataBankAccounts['inputBankAccountsID']]);
    }  

      public function deleteBankAccount($BankAccountsID)
    {
        return $this->db->table('bank_accounts')->delete(['id' => $BankAccountsID]);
    }  

    public function deleteUserBankAccount($userID)
    {
        return $this->db->table('bank_accounts')->delete(['id_user' => $userID]);
    }   

}
