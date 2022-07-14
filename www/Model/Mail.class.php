<?php
namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Core\BaseSQL;

require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
require_once('vendor/phpmailer/phpmailer/src/Exception.php');
require_once('vendor/autoload.php');

class Mail extends BaseSQL
{
    protected $token;
    protected $mail;
    protected $id = null;

    public function __construct()
    {
        $envFile= 'env.json';
        $json_data = file_get_contents($envFile);
        $config = json_decode($json_data, true);

        if (empty($config['env'][1]['SMTP_HOST'])
            && empty($config['env'][1]['SMTP_PORT'])
            && empty($config['env'][1]['SMTP_SECURE'])
            && empty($config['env'][1]['SMTP_USERNAME'])
            && empty($config['env'][1]['SMTP_PASSWORD'])){
            // http_response_code(404);
            die();
        }

        $this->mail = new PHPMailer(TRUE);
        $this->mail->isSMTP();
        $this->mail->Host = $config['env'][1]['SMTP_HOST'];
        $this->mail->SMTPAuth = TRUE;
        $this->mail->SMTPSecure = $config['env'][1]['SMTP_SECURE'];
        $this->mail->Username = $config['env'][1]['SMTP_USERNAME'];
        $this->mail->Password = $config['env'][1]['SMTP_PASSWORD'];
        $this->mail->Port = $config['env'][1]['SMTP_PORT'];
        $this->mail->IsHTML(true);

        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->setFrom($this->mail->Username, "CMS PORTFOLIO");
    }

    public function sendEmail($to_email, $to_name, $subject, $message)
    {

        try {
            ob_start();
            $message = $message;
            include("View/Partial/mail.partial.php");
            $message = ob_get_contents();
            ob_end_clean();
            $this->mail->addAddress($to_email, $to_name);
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;

            return $this->mail->send();

        }catch (Exception $e){
            echo $e->errorMessage();
        }
        catch (\Exception $e){
            echo $e->getMessage();
        }
        
        $this->mailer->clearAllRecipients();

    }

}