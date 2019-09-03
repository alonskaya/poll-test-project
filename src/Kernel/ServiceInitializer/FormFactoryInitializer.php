<?php

namespace App\Kernel\ServiceInitializer;

use Klein\Klein;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader;
use Symfony\Component\Validator\Validation;

/**
 * Class FormFactoryInitializer
 * @package App\Kernel\ServiceInitializer
 */
class FormFactoryInitializer implements ServiceInitializerInterface
{
    /**
     * @param Klein $klein
     *
     * @return callable
     */
    public static function initService(Klein $klein): callable
    {
        return static function () {
            $validator = Validation::createValidatorBuilder()
                ->setMetadataFactory(new LazyLoadingMetadataFactory(new StaticMethodLoader()))
                ->getValidator();

            $formFactoryBuilder = new FormFactoryBuilder();
            $formFactoryBuilder->addExtension(new ValidatorExtension($validator));

            return $formFactoryBuilder->getFormFactory();
        };
    }
}
