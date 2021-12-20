<?php

namespace App\Form\Type\Bingo\Creation;


use App\Entity\Bingo;
use App\Form\Type\BingoCell\Creation\CreateBingoCellType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateBingoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
            ])
            ->add('height', IntegerType::class, [
                'required' => true,
                'attr' => [
                    'max' => 12,
                    'min' => 2,
                ]
            ])
            ->add('width', IntegerType::class, [
                'required' => true,
                'attr' => [
                    'max' => 12,
                    'min' => 2
                ]
            ])
            ->add('cells', CollectionType::class, [
                'entry_type' => CreateBingoCellType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bingo::class,
        ]);
    }
}
