<?php

namespace App\Form;

use App\Entity\TypeVisit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class TypeVisitType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('type', ChoiceType::class);

	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults( array(
			'data_class'         => TypeVisit::class,
			'translation_domain' => 'forms',

		) );
	}
}
