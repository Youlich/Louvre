<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 06.09.18
 * Time: 11:32
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class PassedDays extends Constraint
{
    public $message = 'The Date "{{ string }}" is not available.';
}