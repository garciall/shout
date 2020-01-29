<?php

namespace App\Controller;

use App\Service\ShoutService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\Constraints;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpFoundation\Response;

class ShoutController extends AbstractFOSRestController
{

    /**
     * @Get("/shout/{author}")
     * @QueryParam(name="limit", requirements={@Constraints\PositiveOrZero, @Constraints\LessThanOrEqual(10)}, default="1", description="Amount of quotes to shout", strict=true)
     * @param string $author
     * @param int $limit
     * @param ShoutService $shoutService
     * @return Response
     */
    public function getAction(string $author, int $limit, ShoutService $shoutService): Response
    {
        $shouts = $shoutService->getShoutsByAuthor(str_replace('-', ' ', $author), $limit);
        return $this->handleView(
            $this->view($shouts)
        );

    }
}