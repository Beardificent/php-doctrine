<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\Type\StudentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class StudentController extends AbstractApiController
{


    /**
     * @Route("/student", name="student")
     */
    public function indexAction(SerializerInterface $serializer)
    {

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();


        $jsonContent = $serializer->serialize($students, 'json');
        return $jsonContent;

    }

    public function createAction(Request $request) : Response
    {
        $form = $this->buildForm(StudentType::class);

        $form->handleRequest($request);

        //form handling
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
