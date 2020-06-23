<?php

namespace App\Form;

use App\Entity\Difficulte;
use App\Entity\Prix;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_recette', TextType::class)
            ->add('temps', TimeType::class)
            ->add('nombre_personne', IntegerType::class)
            ->add('image', FileType::class, array(
                'label' => 'Image(JPG/PNG)'
            ))
            ->add('images', FileType::class, array(
                'label' => 'Image(JPG/PNG)',
                'multiple' => true
            ))
            ->add('prix', EntityType::class, array(
                'class' => Prix::class,
                'choice_label' => 'nomprix',
            ))
            ->add('difficulte', EntityType::class, array(
                'class' => Difficulte::class,
                'choice_label' => 'nomdifficulte',
                ))
            ->add('etape', TextareaType::class)
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
