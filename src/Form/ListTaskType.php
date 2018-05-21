<?php

namespace App\Form;

use App\Entity\ListTask;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ListTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ], 'label' => 'Task*'
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => array(
                    'High' => 3,
                    'Normal' => 2,
                    'Low' => 1,
                ),
                'expanded' => true,
                'constraints' => [
                    new NotBlank(),
                ], 'label' => 'Priority']);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListTask::class,
        ]);
    }
}
