<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Training;
use App\Repository\PersonRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonRegistrationFormType extends AbstractType
{

    private $PersonRepository;
    public function __construct(PersonRepository $PersonRepository)
    {
        $this->PersonRepository = $PersonRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = date('Y');
        $pastDate= date('Y', strtotime('+1 years'));
        $builder
            ->add('time', TimeType::class, [
                'label'=>'Tijdstip',
                'widget' => 'choice',
                'minutes' => [5,10,15,20,25,30,35,40,45,50,55]
                ])
            ->add('date', null, ['years' => range($date, $pastDate ), 'format' => 'dd MMMM yyy','label'=>'Datum'])
            ->add('location', ChoiceType::class, [
                'label'=>'Locatie',
                'choices' => [
                    'Den Haag' => 'Den Haag',
                    'Delft' => 'Delft',
                ]
            ])
            ->add('max_persons', NumberType::class, [
                'attr' => array(
                    'scale' => 0,
                    'min' =>0,
                    'max' =>999,
                    'step' =>1 ,
                    'placeholder' => '0'
                ),
                'label'=>'Aantal inschrijvingen'])
            ->add('training', EntityType::class, [
                'class' => Training::class,
                'choice_label' => 'Naam',
                'label' => 'Activiteit'
            ])
            ->add('person', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'firstname',
                'choices' => $this->PersonRepository->findAllInstructors(),
                'label' => 'instructeur'
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
