<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PollActingType
 * @package App\Form
 */
class PollActingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add(
                'name',
                TextType::class,
                [
                    'label'    => 'Your name',
                    'required' => true,
                ]
            )
            ->add(
                'question',
                TextType::class,
                [
                    'label'    => 'Question',
                    'disabled' => true,
                ]
            )
            ->add(
                'answers',
                ChoiceType::class,
                [
                    'label'    => 'Answers',
                    'multiple' => false,
                    'expanded' => true,
                    'required' => true,
                    'choices'  => $options['choices'],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('choices');
        $resolver->setAllowedTypes('choices', 'array');
    }
}
