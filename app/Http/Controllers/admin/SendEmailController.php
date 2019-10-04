<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Config;
use Auth;
use DB;

class SendEmailController extends Controller
{
    

    public function __construct()
    {
       
    }

    public function sendEmail($to,$subject,$messageBody)
    {
        $mail = new \App\Library\MailService;
        $dataMail = [];
        $dataMail = array(
            'to' => array($to),
            'subject' => $subject,
            'content' => $messageBody
        );
        $this->setupEmailConfig();
        $mail->send($dataMail,'emails.send_email');

    }

    public function sendEmailWithAttachment($to,$subject,$messageBody,$invoiceName)
    {
        $mail = new \App\Library\MailService;
        $dataMail = [];
        $dataMail = array(
            'to' => array($to),
            'subject' => $subject,
            'content' => $messageBody,
            'attach'  =>url("public/uploads/invoices/$invoiceName")
        );
        $this->setupSmtpConfig();
        $mail->send($dataMail,'emails.send_email');

        @unlink(public_path('/uploads/invoices/'.$invoiceName));

    }


    public function setupSmtpConfig(){

    $result = DB::table('email_settings')->first();
    Config::set([
            'mail.driver'     => 'smtp',
            'mail.host'       => isset($result->host) ? $result->host : '',
            'mail.port'       => isset($result->port) ? $result->port : '',
            'mail.from'       => ['address' => isset($result->from_address) ? $result->from_address : '',
                                  'name'    => isset($result->from_name) ? $result->from_name : '' ],
            'mail.encryption' => isset($result->encryption) ? $result->encryption : '',
            'mail.username'   => isset($result->username) ? $result->username : '',
            'mail.password'   => isset($result->smtp_password) ? $result->password : ''
            ]);

    }

}
