<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

abstract class AbstractApiController extends AbstractController
{
    protected function buildForm(string $type, $data = null, array $options = []): FormInterface
    {
        $options = array_merge($options, [
            'csrf_protection' => false
        ]);
        return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
    }

    protected function respond ($data, int $statusCode = Response::HTTP_OK): Response
    {
        return $this->handleView($this->view($data, $statusCode));
    }
}
