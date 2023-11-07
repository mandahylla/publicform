<?php

/**
 * CodeIgniter PHPMailer Class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category    Libraries
 * @author      CodexWorld
 * @link        https://www.codexworld.com
 */

namespace App\Libraries;

class Const_lib
{
    /**
     * Phpmailer_lib constructor.
     */
    public function __construct()
    {
        log_message('debug',"Constance Librairies is loaded !");
    }

    public function loadFormula()
    {
        $constArray = [
            
            // 'F1' => '1 Million FCFA Retrait DAB | 1 Million FCFA Paiement TPE',

            'F2' => '5 Millions FCFA Retrait DAB | 0 FCFA Paiement TPE',

            'F3' => '2,5 Millions FCFA Retrait DAB | 2,5 Millions FCFA Paiement TPE',

            'F4' => '0 FCFA Retrait DAB | 5 Millions FCFA Paiement TPE',
        ];

        return $constArray;
    }

    public function loadPurpose()
    {
        $constArray = [

            /* "O1"  => "Chefs de missions diplomatiques, diplomates, assimilés et/ou leurs familles issus des pays de la CEMAC (6 mois d'activation max)",
            "O2"  => "Traitement médical hors CEMAC et/ou accompagnateurs (selon les justificatifs avec 6 mois d'activation max)",
            "O3"  => "Etude à l'étranger relevant d'un résident de la CEMAC (plafonné de 2M FCFA par mois sur 12 mois d'activation max)",
            "O4"  => "Fonctionnaires employés hors CEMAC dans des enclaves territoriales (6 mois d'activation max)",
            "O5"  => "Mission militaire hors CEMAC (6 mois d'activation max)",
            "O6"  => "Travails saisonniers, résidents de la CEMAC, exerçant hors CEMAC (6 mois d'activation max)",
            "O7"  => "Formation, stage, mission hors CEMAC à l'initiative d'une entité résidente en zone CEMAC (6 mois d'activation max)",
            "O8"  => "Membre d'équipages (navires, aéronefs et plateformes pétrolières) à l'étranger résidant dans la CEMAC (6 mois d'activation max)",
            "O9"  => "Pèlerinage, participant à une foire, une activité sportive ou culturelle ou toute activité assimilée (3 mois d'activation max)", */
            10 => "Tourisme ou Déplacement ponctuel",
            12 => "Visite Familiale",
            13 => "Voyage d'Affaire"
        ];

/*         $constArray = [

            "O1"  => "Chefs de missions diplomatiques, diplomates et assimilés et/ou membres de leurs familles issus des pays de la zone CEMAC (6 mois d'activation maximum)",
            "O2"  => "Traitement médical à l'extérieur de la CEMAC et/ou personnes accompagnateurs (selon les justificatifs avec 6 mois d'activation maximum)",
            "O3"  => "Etude à l'étranger relevant d'un ménage résident de la CEMAC (plafonné de 2M FCFA par mois sur 12 mois d'activation maximum)",
            "O4"  => "Fonctionnaires des états de la CEMAC employés à l'extérieur de ceux-ci dans des enclaves territoriales (6 mois d'activation maximum)",
            "O5"  => "Mission Militaire à l'extérieur de la CEMAC (6 mois d'activation maximum)",
            "O6"  => "Travails Saisonniers, résidents de la CEMAC, exerçant hors zone CEMAC (6 mois d'activation maximum)",
            "O7"  => "Formation, Stage, Mission ou Travail en alternance à l'étranger à l'initiative d'une entité résidente en zone CEMAC (6 mois d'activation maximum)",
            "O8"  => "Membre d'équipages des navires, aéronefs et plateformes pétrolières à l'étranger résidant dans la zone CEMAC (6 mois d'activation maximum)",
            "O9"  => "Pèlerinage, Participant à une foire, une activité sportive ou culturelle ou toute activité assimilée (3 mois d'activation maximum)",
            "O10" => "Tourisme ou Déplacement ponctuel (1mois maximum)"
        ]; */
        return $constArray;
    }

    public function loadBcType()
    {
        $constArray = [
            "Gold" => "Gold",
            "Privilège" => "Privilège",
            "Elite" => "Elite",
        ];

        return $constArray;
    }
}