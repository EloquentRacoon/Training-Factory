<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = date('Y');
        $pastDate= date('Y', strtotime('-80 years'));

        $builder
            ->add('password', PasswordType::class, array(
                'mapped' => false,
                'label' => 'Huidig wachtwoord'))
            ->add('emailaddress', null, ['label' => 'Email adress' ])
            ->add('firstname', null, ['label' => 'Voornaam', 'attr' => ['class' => 'text-capitalize']])
            ->add('preprovision', null, ['label' => 'Tussen voegsel'])
            ->add('lastname', null, ['label' => 'Achternaam',  'attr' => ['class' => 'text-capitalize']])
            ->add('dateofbirth', null , ['years' => range($date, $pastDate ), 'format' => 'dd MMMM yyyy', 'label' => 'Geboorte datum'])
            ->add('gender', ChoiceType::class, ['choices' => [
                'Man' => 'Man',
                'Vrouw' => 'Vrouw',
                'Anders' => 'Anders'],
                'label' => 'Geslacht'])

//          ->add('street')
//          ->add('postal_code')
//          ->add('place')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
