<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TaskType
 *
 * @package App\Form
 */
class TaskType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<array>                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name')
            ->add('linkGithub')
            ->add('linkWebsite')
            ->add(
                'skills',
                null,
                [
                    "choice_label" => "name",
                    "expanded" => true,
                    "multiple" => true,
                ]
            );
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }

}
