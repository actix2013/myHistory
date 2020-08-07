<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<array>                                 $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name')
            ->add(
                'category',
                null,
                [
                    "label" => "Categorie",
                    "choice_label" => "name",
                    "expanded" => false,
                    "multiple" => false,
                ])
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
