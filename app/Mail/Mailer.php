<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class Mailer extends Mailable
{
  protected MailTemplate $mail;
  protected Mailable $mailable;

  public function __construct(MailTemplate $mail)
  {
    $this->mail = $mail;
  }

  public function build()
  {
    $address = $this->mail->getEmail();
    $subject = $this->mail->getSubject();
    $name = $this->mail->getName();

    $this->mailable = $this->view($this->mail->getView())
      ->from(env("MAIL_FROM_ADDRESS"), $name)
      ->to($address)
      ->cc($address, $name)
      ->bcc($address, $name)
      ->replyTo($address, $name)
      ->subject($subject)
      ->with([ 'data' => $this->mail->getData()]);

    return $this;
  }

  public function process()
  {
    Mail::to($this->mail->getEmail())->send($this->mailable);
  }
}