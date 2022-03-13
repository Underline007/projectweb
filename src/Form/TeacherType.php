<?php

namespace App\Form;

use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tid')
            ->add('name', TextType::class,
            [
                'attr'=>[
                    'maxlength'=>30,
                    'minlength'=>10
                ]
            ])
            ->add('birthday',DateType::class,
            [
                'widget' =>'single_text'
            ])
            ->add('image')
            ->add('subjects',EntityType::class,
            [
                'class'=> Subject::class,
                'choice_label'=>'name',
                'multiple'=> true,//default:false
                'expanded'=> false //checkbox
                //'expanded'=> false : dropdown
            ])
            //->add('subjects')
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
