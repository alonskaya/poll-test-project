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
    public $message = 'The poll cannot contain the same answer choices';
}
