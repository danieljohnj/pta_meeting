<?php
    require 'vendor/autoload.php';

    class sendemail{
        public static function sendmail($to, $subject, $content){
            $key = '7EBA75EDF37F7F38DE1AE3577C19EFC8BC6DDC0304493F89E1BBE0158ED20F8359F78CCE4E8382C6DD306997EE4E1ECD';
            $email = new \SendGrid\Mail\Mail();
            $email->setfrom('danieljohnj@gmail.com', 'daniel email');
            $email->setsubject($subject);
            $email->addTo($to);
            $email->addcontent('text/plain', $content);

            $emailapi = new \SendGrid($key);

            try{
                $response = $emailapi->send($email);
                return $response;


            }catch(exception $e){
                echo 'Email exception caught :' . $e->getMessage() ."\n";
                return false;
            }
        }
    }



?>