<?php 

namespace App\Validators;

use CodeIgniter\Validation\Rules;
use App\Models\BankAccountModel;

class CustomDigitRules extends Rules
{
    public function digitCheck(string $str, string $field=null, array $data=null): bool
    {
        
        return (preg_match("/^[0-9]{4}$/", $str)) ;
    }
}