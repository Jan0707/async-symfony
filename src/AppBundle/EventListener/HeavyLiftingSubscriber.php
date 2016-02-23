<?php

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use AppBundle\Service\HeavyLiftingService;

class HeavyLiftingSubscriber implements EventSubscriberInterface
{
    /**
     * @var HeavyLiftingService
     */
    protected $service;

    /**
     * HeavyLiftingListener constructor.
     *
     * @param HeavyLiftingService $service
     */
    public function __construct(HeavyLiftingService $service)
    {
        $this->service = $service;
    }

    /**
     * @param PostResponseEvent $event
     */
    public function onTermination(PostResponseEvent $event)
    {
        $this->service->lift($event->getRequest()->get('name'));
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::TERMINATE => 'onTermination'];
    }
}
