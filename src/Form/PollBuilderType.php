<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class PollBuilderType
 * @package App\Form
 */
class PollBuilderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('question', TextType::class, [
                'label' => 'Question',
            ])
            ->add('answers', EntryType::class, [
                'allow_add'    => true,
                'allow_delete' => true,
                'label'        => 'Answers',
            ]);
    }
}
