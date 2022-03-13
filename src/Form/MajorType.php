<?php

namespace App\Form;

use App\Entity\Major;
use PhpParser\Builder\Interface_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class MajorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Majorid')
            
            ->add('Majorname',TextType::class,
            [
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('Trainingtime', IntegerType::class,
            [
                'attr' => [
                    'max' => 5,
                    'min' => 3
                ]
            ])
            ->add('Trainingsystem',ChoiceType::class,
            [
                'choices' => [
                    'University' => 'University',
                    'College' => 'College'
                ],
                'expanded' => true //false: drop-down
                                    //true: radio button
            ])
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
