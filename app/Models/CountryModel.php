<?php

namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'countries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code','name'];

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

    public function getCountries($CountriesID = false)
    {
        if ($CountriesID) {
            return $this->db->table('countries')
            ->where(['countries.id' => $CountriesID])
            ->get()->getRowArray();
        } else {
            return $this->db->table('countries')
            ->get()->getResultArray();
        }
    }

    public function getNoCemacCountries($CountriesID = false)
    {
        if ($CountriesID) {
            return $this->db->table('countries')
            ->where(['countries.id' => $CountriesID])
            ->get()->getRowArray();
        } else {
            return $this->db->table('countries')
            ->where(['countries.cemac_zone' => '0'])
            ->get()->getResultArray();
        }
    }
}
