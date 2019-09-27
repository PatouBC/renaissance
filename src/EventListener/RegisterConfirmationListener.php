<?php

namespace App\EventListener;

use App\Entity\User;
use App\Event\FilterUserRegistrationEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use Swift_Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Environment;

class RegisterConfirmationListener implements EventSubscriberInterface
{
    private $mailer;
    private $tokenGenerator;
    private $session;
    private $templating;
    private $swift;

    /**
     * EmailConfirmationListener constructor.
     *
     * @param MailerInterface         $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     * @param SessionInterface        $session
     */
    public function __construct(MailerInterface $mailer,
                                TokenGeneratorInterface $tokenGenerator,
                                SessionInterface $session,
                                Environment $templating,
                                Swift_Mailer $swift_Mailer)
    {
        $this->mailer = $mailer;
        $this->tokenGenerator = $tokenGenerator;
        $this->session = $session;
        $this->templating = $templating;
        $this->swift = $swift_Mailer;

    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            "user_registration.created" => [
                ["onRegistrationSuccess", 0]
            ]
        ];
    }

    /**
     * @param FilterUserRegistrationEvent $event
     */
    public function onRegistrationSuccess(FilterUserRegistrationEvent $event)
    {
        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getUser();

        $user->setEnabled(false);
        if (null === $user->getConfirmationToken()) {
            $user->setConfirmationToken($this->tokenGenerator->generateToken());
        }

        $this->mailer->sendConfirmationEmailMessage($user);
        $this->sendMailToAdmin($event);
        
        $this->session->set('fos_user_send_confirmation_email/email', $user->getEmail());

        $event->stopPropagation();
    }


    public function sendMailtoAdmin(FilterUserRegistrationEvent $event)
    {
        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getUser();
        $sendTo = 'perez.valerie@live.fr';
        $message = (new \Swift_Message('Nouvel Utilisateur !'))
            ->setFrom('no-reply@renaissance-terrehappy.fr')
            ->setTo($sendTo)
            ->setBody(
                $this->templating->render(
                    'emails/user_creation.email.twig',
                    ['user' => $user]
                ),
                'text/html'
            );
        $this->swift->send($message);
    }


}
