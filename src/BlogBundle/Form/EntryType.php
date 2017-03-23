<?php

namespace BlogBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array("label"=>"Titulo","required"=>"required", "attr" =>array(
                "class" => "form-control"
            )))
            ->add('content', TextareaType::class, array("label"=>"Contenido","required"=>"required", "attr" =>array(
                "class" => "form-control"
            )))
            ->add('status', ChoiceType::class, array("label"=>"Estado", "choices" => array("Publicado" => "public", "Privado" => "private"
            ), "attr" =>array(
                "class" => "form-control"
            )))
            ->add('image', FileType::class, array(
                "label" => "Imagen",
                "attr" =>array(
                    "class" => "form-control",
                ),
                "data_class" => null,
                "required" => false
            ))
            ->add('category', EntityType::class, array(
                "class" => "BlogBundle:Category",
                "label" => "Categorías:",
                "attr" =>array(
                    "class" => "form-control"
                )
            ))
            ->add('tags', TextType::class, array("mapped"=>false,"label"=>"Etiquetas","required"=>"required", "attr" =>array(
                "class" => "form-control"
            )))
            ->add('Guardar', SubmitType::class, array("attr" =>array(
                "class" => "form-submit btn btn-success"
            )))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Entry'
        ));
    }
}
