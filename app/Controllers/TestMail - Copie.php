<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TestMail extends BaseController {
    
    public function __construct() {
        
    }
    
    public function compose() {
    
        echo view('compose');
    
    }
    
    public function send_email() {
    
        $email          = $this->request->getPost('email');
        $subject        = $this->request->getPost('subject');
        $message        = $this->request->getPost('message');
        
        $mail = new PHPMailer(true);  
        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();  
            $mail->Host         = '10.161.46.10'; //smtp.google.com
            $mail->SMTPAuth     = true;     
            $mail->Username     = 'cedrick-marc.mandahylla@creditducongo.com';  
            $mail->Password     = 'Cedrick@éàéà!';
            $mail->SMTPSecure   = false;            //Enable implicit TLS encryption
            $mail->Port         = 27;  
            $mail->Subject      = $subject;
            $mail->Body         = $message;
            $mail->SetFrom('Noreply@creditducongo.com', ' INFO');
            
            $mail->AddAddress($email);  
            $mail->isHTML(true);      
            
            if(!$mail->send()) {
                echo "Something went wrong. Please try again. : ". $mail->ErrorInfo;
            }
            else {
                echo "Email sent successfully.";
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }
    
}