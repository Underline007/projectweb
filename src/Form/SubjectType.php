<?php

namespace App\Form;

use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sid',TextType::class,[
                'label' => "Subject ID",
                'required' => true,
                'attr'=>[
                    'maxlength'=>10,
                    'minlenght'=>5
                ]
            ])
            ->add('image')
            ->add('name',TextType::class,[
                'label' => "Subject Name",
                'required' => true,
                'attr'=>[
                    'maxlength'=>50,
                    'minlenght'=>5
                ]
            ])
            ->add('teachers',EntityType::class,
            [
                'class'=> Teacher::class,
                'choice_label'=>'name',
                'multiple'=> true,//default:false
                'expanded'=> true //checkbox
                //'expanded'=> false : dropdown
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}
