<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegisterListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_INITIALIZE => 'doSomething',
        ];
    }

    public function doSomething(GetResponseUserEvent $event)
    {
        $url = $this->router->generate('homepage');

        // :troll:
        $event->setResponse(new RedirectResponse($url));
    }
}
