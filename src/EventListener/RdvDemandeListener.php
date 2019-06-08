<?php

namespace App\EventListener;



use App\Entity\DayPart;
use App\Entity\User;
use App\Event\RdvDemandeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Swift_Message;
use Swift_Mailer;
use Twig\Environment;


class RdvDemandeListener implements EventSubscriberInterface
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
            "rdvDemande" => [
                ["onRdvDemande", 0],
            ]
        ];
    }
    public function onRdvDemande(RdvDemandeEvent $event):void
    {
        $daypart = $event->getDayPart();
        $user = $event->getUser();
        if($daypart instanceof DayPart && $user instanceof User)
        {
            $this->sendMail($daypart, $user);
            $event->stopPropagation();
        }
    }

    private function sendMail(DayPart $daypart, User $user) : void
    {
        $sendTo  = 'patricia.bergez@gmail.com';
        $message = (new Swift_Message('Nouvelle demande de rendez-vous'))
            ->setFrom('no-reply@renaissance-terrehappy.fr')
            ->setTo($sendTo)
            ->setBody(
                $this->templating->render(
                    'emails/rdv_demande.email.twig',
                    ['user' => $user, 'daypart' => $daypart]
                ),
                'text/html'
            );
        $this->swift->send($message);
    }
}