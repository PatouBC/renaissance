<?php

namespace App\EventListener;



use App\Entity\Message;
use App\Entity\User;
use App\Event\MessageSentEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Swift_Message;
use Swift_Mailer;
use Twig\Environment;


class MessageSentListener implements EventSubscriberInterface
{
    private $swift;
    private $templating;

    public function __construct( Swift_Mailer  $serviceMail, Environment $templating)
    {
        $this->swift = $serviceMail;
        $this->templating = $templating;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            "messageSent" => [
                ["onMessageSent", 0],
            ]
        ];
    }
    public function onMessageSent(MessageSentEvent $event):void
    {
        $message = $event->getMessage();

        if($message instanceof Message)
        {
            $this->sendMailToAdmin($message);
            $event->stopPropagation();
        }
    }

    private function sendMailToAdmin(Message $message) : void
    {
        $sendTo  = 'patricia.bergez@gmail.com';
        $email = (new Swift_Message('Nouveau message'))
            ->setFrom('no-reply@renaissance-terrehappy.fr')
            ->setTo($sendTo)
            ->setBody(
                $this->templating->render(
                    'emails/message.email.twig',
                    [ 'message' => $message]
                ),
                'text/html'
            );
        $this->swift->send($email);
    }

}