<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class StringSetValidator
 * @package App\Constraints
 */
class StringSetValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     *
     * @throws UnexpectedTypeException
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof StringSet) {
            throw new UnexpectedTypeException($constraint, StringSet::class);
        }

        if (!is_array($value) && !$value instanceof \Traversable) {
            throw new UnexpectedTypeException($value, sprintf('%s or array', \Traversable::class));
        }

        if (count($value) !== count(array_unique($value))) {
            $this->context->buildViolation($constraint->message)->addViolation();

            return;
        }
    }
}
