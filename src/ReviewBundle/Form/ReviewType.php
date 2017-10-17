<?php

namespace ReviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rating', IntegerType::class, ['label' => "Note sur 5"])
            ->add('comment', TextType::class, [
                'label' => "Commentaire",
                'required' => false,
            ])
            ->add('save', SubmitType::class, array('label' => "Noter l'équipe"))
            ->getForm()
        ;
    }
}
