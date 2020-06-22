<?php

namespace App\Form;

use App\Repository\NoteRepository;
use App\Entity\Commentaire;
use App\Entity\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;


class CommentaireType extends AbstractType
{

   
    private $security;
    public function __construct(Security $security)
    {
       
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire', TextareaType::class)
            ->add('note', EntityType::class, [
                'class' => Note::class,
                'label' => 'note'
            ])
            ;
            if(!$this->security->getUser()){
                $builder
                ->add('pseudo',TextType::class);
            }else{
                $builder
                ->add('pseudo',HiddenType::class);
            }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }

    

}
