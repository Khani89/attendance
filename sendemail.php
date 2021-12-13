<?php 
    require 'vendor/autoload.php';

    class sendemail{

        public static function SendMail($to, $subject, $content){
            $key = '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';

            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("khanipowell1@gmail.com", "Khani Powell");
            $email->setSubject($subject);
            $email->addTo($to);
            $email->addContent("text/plain", $content);

            $sendgrid = new \SendGrid($key);

            try{
                $response = $sendgrid->send($email);
                return $response;
            }catch(Exception $e){
                echo 'Email exception Caught : '. $e->getMessage() ."\n";
                return false;
            }
        }

    }

?>