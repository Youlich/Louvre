<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 06.09.18
 * Time: 11:14
 */

namespace App\Validator\Constraints;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateVisitValidator extends ConstraintValidator
{

    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (in_array($value->format('d/m'), $this->params->get('holidays'))) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ string }}', $value->format('d/m/Y'))
                          ->addViolation();
        }
    }
}