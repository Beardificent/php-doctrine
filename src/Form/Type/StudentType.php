<?php


namespace App\Form\Type;


use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotNull;

class StudentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('firstName', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('lastName', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('email', EmailType::class,[
                'constraints' => [
                    new NotNull([
                        'message' => 'Not a valid email format'
                    ]),
                    new Email()
                ]
            ])
            ->add('address_street', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('address_street_number', IntegerType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('address_city', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('address_zipcode', TextType::class,[
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
