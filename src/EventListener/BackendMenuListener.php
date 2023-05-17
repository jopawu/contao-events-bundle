<?php

namespace iit\ContaoEventsBundle\EventListener;

/**
 * @ServiceTag("kernel.event_listener", event="contao.backend_menu_build", priority=-255)
 */
class BackendMenuListener
{
    protected $router;
    protected $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function __invoke(MenuEvent $event): void
    {
        $factory = $event->getFactory();
        $tree = $event->getTree();

        if ('mainMenu' !== $tree->getName())
        {
            return;
        }

        $contentNode = $tree->getChild('content');

        $node = $factory
            ->createItem('iit-events-backend')
            ->setUri($this->router->generate(BackendController::class))
            ->setLabel('iit Events')
            ->setLinkAttribute('title', 'iit Events')
            ->setLinkAttribute('class', 'iit-events-backend')
            ->setCurrent($this->requestStack->getCurrentRequest()->get('_controller') === BackendController::class)
        ;

        $contentNode->addChild($node);
    }
}