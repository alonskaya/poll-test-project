<?php

namespace App\Form;

use App\Constraints\StringSet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EntryType
 * @package App\Form
 */
class EntryType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'allow_add'     => true,
                'allow_delete'  => true,
                'entry_type'    => TextType::class,
                //'constraints'   => [new StringSet(['value_field' => 'answer'])],
                'cascade_validation' => true

            ]
        );

        $resolver->setAllowedValues('entry_type', [TextType::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return CollectionType::class;
    }
}
