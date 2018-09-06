<?php

namespace App\Validator\Constraints;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class HolidaysValidator extends ConstraintValidator
{
	private $params;

	public function __construct(ParameterBagInterface $params)
	{
		$this->params = $params;
	}
//mardi et jours fériés
	public function validate($value, Constraint $constraint)
	{
		if (in_array($value->format('d/m'), $this->params->get('holidays'))) {
			$this->context->buildViolation($constraint->message)
			              ->setParameter('{{ string }}', $value->format('d/m/Y'))
			              ->addViolation();
		}
		if ( $value->format( 'w' ) == '2' ) {
			$this->context->buildViolation($constraint->message)
			              ->setParameter('{{ string }}', $value->format( 'w' ) == '2')
			              ->addViolation();
		}
	}
}