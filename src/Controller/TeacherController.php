<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Teacher;
use App\Form\Type\TeacherType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TeacherController extends AbstractApiController
{
    /**
     * @Route("/teacher", name="teacher")
     */
    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }

    /**
     * @Route("/teacherForm", name="teacherForm")
     */
    public function newAction(Request $request)
    {
        $teacher = new Teacher();

        $student1 = new Student ();
        $student1->name = "help";

        $form = $this->createForm(new TeacherType(), $teacher);

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->persist($teacher);
                $this->getDoctrine()->getManager()->flush();
            }
        }
    }


    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $teacher = $em->getRepository('Teacher')->find($id);

        if (!$teacher) {
            throw $this->createNotFoundException('No teacher found for is '.$id);
        }

        $originalStudents = array();

        // Create an array of the current Tag objects in the database
        foreach ($teacher->getStudents() as $student) {
            $originalStudents[] = $student;
        }

        $editForm = $this->createForm(new TeacherType(), $teacher);

        if ('POST' === $request->getMethod()) {
            $editForm->handleRequest($this->getRequest());

            if ($editForm->isValid()) {

                // filter $originalTags to contain tags no longer present
                foreach ($teacher->getStudents() as $student) {
                    foreach ($originalStudents as $key => $toDel) {
                        if ($toDel->getId() === $student->getId()) {
                            unset($originalStudents[$key]);
                        }
                    }
                }

                // remove the relationship between the tag and the Task
                foreach ($originalStudents as $student) {
                    // remove the Task from the Tag
                    $student->getTeacher()->removeElement($teacher);

                    // if it were a ManyToOne relationship, remove the relationship like this
                    // $student->setTeacher(null);

                    $em->persist($student);

                    // if you wanted to delete the Student entirely, you can also do that
                    // $em->remove($student);
                }

                $em->persist($teacher);
                $em->flush();

                // redirect back to some edit page
                return $this->redirect($this->generateUrl('teacher_edit', array('id' => $id)));
            }
        }

        return $this->render('teacher/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
