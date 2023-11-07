<?php 

namespace App\Validators;

use CodeIgniter\Validation\Rules;
use App\Models\BankAccountModel;

class CustomDateRules extends Rules
{
    public function repeated(string $str, string $field, array $data): bool
    {
        
        $model = new BankAccountModel();
        $acc   = $model->where('acc_num', $str)
                       ->get()->getResultArray();                      
        
        $count = count($acc);
        $b_count = !(isset($count) && ($count === 2)) ;
        // dd($b_count);
        return $b_count;
    }
}