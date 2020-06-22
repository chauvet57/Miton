<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Difficulte;
use App\Entity\Prix;
use App\Entity\Recette;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
            //->add('valide')
            ->add('temps', TimeType::class)
            ->add('nombre_personne', IntegerType::class)
            ->add('image', FileType::class, array(
                'label' => 'Image(JPG/PNG)'
            ))
            ->add('images', FileType::class, array(
                'label' => 'Image(JPG/PNG)',
                'multiple' => true
            ))
            /*->add('categories', EntityType::class, array(
                'class' => Categorie::class,
                'choice_label' => 'categoriename',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id > :id')
                        ->setParameter('id', 1);
                }
                
                ))*/
            //->add('ingredient')
            //->add('user', HiddenType::class)
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
