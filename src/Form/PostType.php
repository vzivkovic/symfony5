<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'attr'  => [
                        'placeholder' => 'Title',
                    ],
                ]
            );
        $builder
            ->add('body', TextareaType::class, [
                'label' => false,
            ])
            ->add(
                'image',
                null,
                [
                    'attr'  => [
                        'placeholder' => 'Image',
                    ],
                ]
            )
            ->add(
                'time',
                    TextType::class,
                [
                    'constraints'=>array(
                        new GreaterThanOrEqual("today")
                    ),
                    'data' => new \DateTime(),
                    'attr'  => [
                        'placeholder' => 'Time',
                    ],
                ]
            );
        $builder
            ->add(
                'submit',
                ButtonType::class,
                [
                    'attr' => [
                        'forgotten'   => false,
                        'placeholder' => 'placeholder',
                        'title'       => 'title',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Post::class,
                'cascade_validation' => true,
                'label'              => false,
            ]
        );
    }
}
