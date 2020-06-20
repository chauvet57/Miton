<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_recette')
            ->add('valide')
            ->add('temps')
            ->add('nombre_personne')
            ->add('image')
            ->add('images')
            ->add('categories')
            ->add('ingredient')
            ->add('user')
            ->add('prix')
            ->add('difficulte')
            ->add('etape')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
