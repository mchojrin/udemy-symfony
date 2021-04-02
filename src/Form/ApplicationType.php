<?php

namespace App\Form;

use App\Entity\Applicant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'applicant.application.form.name.label'
            ])
            ->add('email', null, [
                'label' => 'applicant.application.form.email.label'
            ])
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'applicant.application.form.birthdate.label'
            ])
            ->add('save', SubmitType::class,[
                'label' => 'applicant.application.form.submit.label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Applicant::class,
        ]);
    }
}
