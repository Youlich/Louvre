<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PassedDaysValidator extends ConstraintValidator {


	public function validate($value, Constraint $constraint) {
		$now = new \DateTime( 'now' );
		if ( $value->format( 'dd/MM/yyyy' ) < $now->format( 'dd/MM/yyyy' ) ) {
			$this->context->buildViolation($constraint->message)
			              ->setParameter('{{ string }}', $value->format( 'dd/MM/yyyy' ) < $now->format( 'dd/MM/yyyy' ))
			              ->addViolation();
		}
	}
}