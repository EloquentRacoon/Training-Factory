<?php

namespace App\Form;

use App\Entity\Training;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class TrainingRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam', null, ['label' => 'Naam Training'])
            ->add('desciption', null, ['label' => 'Descriptie'])
            ->add('duration', TimeType::class, [
                'widget' => 'choice',
                'hours' => [0,1,2,3,4,5,6,7,8,9,10,11,12],
                'label' => 'Duratie'])
            ->add('costs', MoneyType::class, [
                'scale' => 2,
                'attr' => array(
                    'placeholder' => '00.00',
                ),
                'label' => 'Prijs']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
