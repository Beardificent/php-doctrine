<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\Type\StudentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractApiController
{
    /**
     * @Route("/student", name="student")
     */
    public function indexAction(Request $request): Response
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();

        return $this->json($students);

    }

    public function createAction(Request $request) : Response
    {
        $form = $this->buildForm(StudentType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()){
         return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var Student $student */
        $student = $form->getData();

        $this->getDoctrine()->getManager()->persist($student);
        $this->getDoctrine()->getManager()->flush();

        var_dump($student);
        return $this->respond($student);
    }

    /**
     * @Route("/showForm", name="showForm")
     */
    public function new(Request $request){
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        return $this->render('student/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
