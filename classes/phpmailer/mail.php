<?php
// include('phpmailer.php');
// class Mail extends PhpMailer
// {
//     // Set default variables for all new objects
//     public $From     = 'yousavevideo@yahoo.com';
//     public $FromName = SITETITLE;
//     public $Host     = 'smtp.mail.yahoo.com';
//     public $Mailer   = 'smtp';
//     public $SMTPAuth = true;
//     public $Username = 'yousavevideo?';
//     public $Password = 'prakash123';
//     public $SMTPSecure = 'tls';
//     public $WordWrap = 75;
//     public $Port = 587;

//     public function subject($subject)
//     {
//         $this->Subject = $subject;
//     }

//     public function body($body)
//     {
//         $this->Body = $body;
//     }

//     public function send()
//     {
//         $this->AltBody = strip_tags(stripslashes($this->Body))."\n\n";
//         $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
//         return parent::send();
//     }
// }



$sendgrid = new SendGrid('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');

$email = new Email();
$email
    ->addTo('arunslb123@gmail.com')
    //->addTo('bar@foo.com') //One of the most notable changes is how `addTo()` behaves. We are now using our Web API parameters instead of the X-SMTPAPI header. What this means is that if you call `addTo()` multiple times for an email, **ONE** email will be sent with each email address visible to everyone.
    ->setFrom('me@bar.com')
    ->setSubject('Subject goes here')
    ->setText('Hello World!')
    ->setHtml('<strong>Hello World!</strong>')
;

$sendgrid->send($email);


?>