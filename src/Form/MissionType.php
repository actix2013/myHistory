<?php

namespace App\Form;

use App\Entity\Mission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('establishmentName')
            ->add('title')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('comment')
            ->add('mission')
            ->add('linkGitHub')
            ->add('linkWebsite')
            ->add('linkEstablishment')
            ->add('establishmentDepartmentNb')
            ->add('type')
            ->add('user')
            ->add('skills')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
