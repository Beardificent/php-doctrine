<?php


namespace App\Form\Type;


use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class TeacherType extends AbstractType
{
    //Added this from block 4 of : https://symfony.com/doc/2.0//cookbook/form/form_collections.html
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);
        $builder->add('email', EmailType::class);


        $builder->add('students', 'collection', array('type' => new StudentType()));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'src\Entity\Teacher',
        );
    }

    public function getTeacher()
    {
        return 'teacher';
    }
}
