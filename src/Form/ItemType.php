<?php

namespace App\Form;

use App\Entity\Priority;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \App\Entity\Item;

class ItemType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank(),
                ],
                'expanded' => true,
            ])
            ->add('note', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
