<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class StringSet
 * @package App\Constraints
 */
class StringSet extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Element {{ elem }} already exists';

    /**
     * @var string
     */
    public $value_field = null;
}
