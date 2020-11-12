<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestController extends AbstractController
{
    /**
     * @Route("/rest", name="rest")
     */
    public function index(): Response
    {
        return $this->render('rest/index.html.twig', [
            'controller_name' => 'RestController',
        ]);
    }
}
