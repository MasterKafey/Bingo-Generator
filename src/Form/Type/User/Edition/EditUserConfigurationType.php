<?php

namespace App\Form\Type\User\Edition;

use App\Entity\UserConfiguration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bingoBackgroundColor', ColorType::class)
            ->add('bingoButtonUncheckedColor', ColorType::class)
            ->add('bingoButtonCheckingColor', ColorType::class)
            ->add('bingoButtonCheckedColor', ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserConfiguration::class
        ]);
    }
}
