<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;


class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $nbTickets=array();
	    for($nb=0;$nb<11;$nb++)
	    {
		    $nbTickets[] = $nb;
	    }

        $builder

            ->add('dateVisit', DateType::class, array(
            	'label' => 'formbooking.dateVisit',
	            'required' => false,
	            'widget' =>'single_text',
	            'format' =>'dd/MM/yyyy',
	            ))

            ->add('nbTicket', ChoiceType::class, array(
            	'choices'=> $nbTickets,
	            'label'=> 'formbooking.nbticket',
	            'placeholder' => ''
            ))
	        ->add('email', EmailType::class, array(
	        	'label' => 'formbooking.mail',
	        ))
	        ->add('typeVisit', EntityType::class, array(
		        'label'   => 'formbooking.typevisit',
		        'class'   => 'App\Entity\TypeVisit',
		        'choice_label' => function ($typeVisit) use ($options) {
			        if ($options['translator'] instanceof TranslatorInterface) {
				        return $options['translator']->trans($typeVisit->getTypeTranslationKey());
			        }
			        return $typeVisit->getType();
		        },
		        'placeholder' => 'formbooking.placeholder.typevisit',
		        'required' => false,
		        'translation_domain' => 'forms',
		        'choice_translation_domain' => true,
	        ))
		    ->add('visitors', CollectionType::class, array(
			        'entry_type' => VisitorType::class,
			        'allow_add' => true,
			        'allow_delete' =>true,
			        'prototype' => true,
			        'label' => false,
			        'by_reference' => false //permet d'appeler le setter dans la fonction addVisitor
	        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
            'translation_domain' => 'forms',
            'translator' => null,
        ]);
    }
}
