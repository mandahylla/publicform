<?php
use CodeIgniter\I18n\Time;

function check_lastValidDemand($user_id)
{
    $db        = \Config\Database::connect();
    $demand    = $db->table('demands')->where(['user_id' => $user_id])->orderBy('id','DESC')->get()->getRowArray();
    
    if (($demand['status_id'] != 1) OR ($demand['status_id'] != 5)) return $demand;

    return false;
}

function checkDovAndDom($bcdov,$bcdom){    // fonction permettant de vérifier la validité de la carte par rapport à la demande

    $now = Time::now('Africa/Brazzaville');
    $dov = Time::parse($bcdov);
    $dom = Time::parse($bcdom);
    $diff = $dom->difference($now);

    if(($dov->isBefore($now)))
    {        
        return $diff->days;
    }

    return false;
}