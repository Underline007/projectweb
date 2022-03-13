<?php

namespace App\Form;

use App\Entity\Major;
use App\Entity\Studentmanager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;






class StudentmanagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class,
            [
                'label' => "Full name",
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            
            ->add('Birthday',DateType::class,
            [
                'widget' => 'single_text'
            ])

            ->add('Gender', ChoiceType::class,
            [
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female'
                ],
                'expanded' => false //false: drop-down
                                    //true: radio button
            ])
            ->add('address')
            ->add('image')
            ->add('major', EntityType::class,
            [
                'class' => Major::class,
                'choice_label' => 'MajorName'
            ]
            )
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
