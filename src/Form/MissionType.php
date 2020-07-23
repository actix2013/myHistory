<?php

namespace App\Form;

use App\Entity\Mission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('establishmentName', null, ["label" => "Entreprise"])
            ->add('establishmentDepartmentNb', null, ["label" => "Département"])
            ->add('title', null, ["label" => "Titre de la mission"])
            ->add('dateStart',
                DateType::class, [
                    "label" => "Date de début de contrat",
                    'format' => 'dd MM yyyy',
                    "placeholder" => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'],
                    'years' => range(2020, 200)])
            ->add('dateEnd',
             DateType::class, [
                 "label" => "Date de fin de contrat",
                'format' => 'dd MM yyyy',
                "placeholder" => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'],
                'years' => range(2020, 200)])
            ->add('comment',null, ["label" => "Commentaire"])
            ->add('mission', null,["label" => "Détails de la mission"])
            ->add('linkEstablishment')

            ->add('type')
            ->add(
                'type',
                ChoiceType::class,
                [
                "label" => "Type",
                "choices" => [
                    "Expérience" => "experience",
                    "Compétence" => "competence",
                    "Formation" => "formation",
                    ]
                ]
            )
            ->add(
                'user',
            null,
                [
                    "label" => "Utilisateur",
                    "choice_label" => "fullName",
                    "expanded" => false,
                    "multiple" => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
