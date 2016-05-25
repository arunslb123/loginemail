<?php
include('phpmailer.php');
class Mail extends PhpMailer
{
      // Set default variables for all new objects
    public $From     = 'noreply@arunprakash.org';
    public $FromName = SITETITLE;
    public $Host     = 'smtp.gmail.com';
    public $Mailer   = 'smtp';
    public $SMTPAuth = true;
    public $Username = 'yousaves123@gmail.com';
    public $Password = 'prakash123@';
    public $SMTPSecure = 'tls';
    public $WordWrap = 75;

    public function subject($subject)
    {
        $this->Subject = $subject;
    }

    public function body($body)
    {
        $this->Body = $body;
    }

    public function send()
    {
        $this->AltBody = strip_tags(stripslashes($this->Body))."\n\n";
        $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
        return parent::send();
    }
}
