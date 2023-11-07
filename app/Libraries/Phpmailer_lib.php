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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Phpmailer_lib
{

    /**
     * Phpmailer_lib constructor.
     */
    public function __construct()
    {
        log_message('debug',"PHPMailer class is loaded !");
    }

    public function load()
    {
        try{
            //        SMTP configure
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->Host       = 'smtp.gmail.com'; //smtp.google.com
            $mail->Username   = 'lartdecoder@gmail.com';  
            $mail->Password   = 'zdidcdcdhjxhsrgc';
            $mail->isHTML(true);

            return $mail;
        }
        catch (Exception $ex)
        {
            dd($ex);
        }
    }
}