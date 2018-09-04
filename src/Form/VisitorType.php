<?php

namespace App\Form;

use App\Entity\Visitor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class VisitorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
            	'label' => 'formvisitor.name',
	            // contraintes ici et pas dans les entités car visitor est un sous-formulaire
	            'constraints' => array(
		            new NotBlank(array('message' => "name.not_blank")),
		            new Length(array("min" =>2, 'minMessage' => "name.min"))
            )))
            ->add('firstName', TextType::class, array(
	            'label' => 'formvisitor.firstname',
	            'constraints' => array(
		            new NotBlank(array('message' => "firstname.not_blank")),
		            new Length(array("min" =>2, 'minMessage' => "firstname.min"))
	            )))
            ->add('birthDate', BirthdayType::class, array(
	            'label' => 'formvisitor.birthday',
	            'constraints' => array(
		            new NotBlank(array('message' => "birthday.not_blank")),
	            )))
	        ->add('country', CountryType::class, array(
		        'required' =>false,
		        'label' => 'formvisitor.country',
		        'preferred_choices' => array('France', 'FR'),
		        ))
	        ->add('reduction', CheckboxType::class, array(
	        	'label' => 'formvisitor.reduct',
		        'required' =>false,
	        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visitor::class,
            'translation_domain' => 'forms'
        ]);
    }
}
