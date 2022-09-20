<?php

namespace App\Mail;

class MailTemplate
{
  protected string $from;
  protected string $name;
  protected string $email;
  protected string $subject;
  protected array $data;
  protected string $view;

  public function __construct()
  {
    $this->from = env("MAIL_FROM_ADDRESS");
    $this->name = env("MAIL_FROM_NAME");
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      throw new \InvalidArgumentException(
          'Endereço de e-mail inválido'
      );
    }

    $this->email = $email;

    return $this;
  }

  public function getSubject(): string
  {
    return $this->subject;
  }

  public function setSubject(string $subject): self
  {
    $this->subject = $subject;

    return $this;
  }

  public function getData(): array
  {
    return $this->data;
  }

  public function setData(array $data): self
  {
    $this->data = $data;

    return $this;
  }

  public function getView(): string
  {
    return $this->view;
  }

  public function setView(?string $view): self
  {
    $this->view = $view;

    return $this;
  }

  public function getName(): string
  {
    return $this->view;
  }

  public function getFrom(): string
  {
    return $this->view;
  }
}