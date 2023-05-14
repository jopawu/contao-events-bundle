<?php

namespace iitContao\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as TwigEnvironment;

/**
 * @Route("/contao/iit-events-backend",
 *     name=iitEventsBackendController::class,
 *     defaults={"_scope": "backend"}
 * )
 */
class iitEventsBackendController
{
    private $twig;

    public function __construct(TwigEnvironment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        return new Response($this->twig->render(
            'iit-events-backend.html.twig',
            []
        ));
    }
}