<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       $company= $options['company'];
       if (!$company instanceof Company) {
            return;
       }
        $builder
            ->add('name', TextType::class, [
                'label' => 'Produktname',
            ])
            ->add('company', HiddenType::class, [
                'data' => $company->getId(),
                'mapped' => false
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Hinzufügen'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('company');
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
