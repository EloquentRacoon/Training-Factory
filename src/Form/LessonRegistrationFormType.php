<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Training;
use App\Repository\PersonRepository;
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
            ->add('time', null, ['label'=>'Tijdstip'])
            ->add('date', null, ['years' => range($date, $pastDate ), 'format' => 'dd MMMM yyy','label'=>'Datum'])
            ->add('location', null, ['label'=>'Locatie'])
            ->add('max_persons', NumberType::class, [
                'attr' => array(
                    'scale' => 0,
                    'min' =>0,
                    'max' =>999,
                    'step' =>1
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
