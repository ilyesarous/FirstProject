<?php

namespace App\Form;

use App\Entity\Show;
use App\Entity\TheaterPlay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbrSeat')
            ->add('dateShow')
            ->add('theaterPlays',  EntityType::class, [
                'class' => TheaterPlay::class,
                'choice_label' => 'title',
                // 'required' => true,
                // 'expanded' => true,
                // 'multiple' => false,
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Show::class,
        ]);
    }
}
