<?php

namespace App\Form;


use App\Entity\Album;
use App\Entity\Style;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder  
            ->add('image')
            ->add('nom',TextType::class,[
                'required' => false,
                'label'=> "nom de l'album",
                'attr'=>[
                    "placeholder"=>"saisir le nom de l'album"
                ]])
            ->add('date',IntegerType::class,[
            'required' => false,
            'label'=> "année de l'album",
            ])
          
            ->add('artiste', EntityType::class,[
                'class'=>Artiste::class,
                'query_builder'=>function(ArtisteRepository $repo){
                    return $repos->listeAttistesimple();
                }, 
                'choice_label'=>'nom',
                'required' => false,
                'label'=> "nom de l'artiste"
            ])
            ->add('styles',EntityType::class,[
                'class'=>Style::class, 
                'choice_label'=>'nom',
                'required' => false,
                'label'=> "Style(s)",
                'multiple'=>true,
                'by_reference'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
