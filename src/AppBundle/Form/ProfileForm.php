<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->getUser($options);

        $builder
            ->add('name', TextType::class, [
                'data' => $user->getName(),
                'attr' => ['class' => 'form-control'],
                'label' => 'Name',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'data' => $user->getEmail(),
                'attr' => ['class' => 'form-control', 'disabled' => 'disabled'],
                'label' => 'Email'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Password field must match',
                'attr' => ['class' => 'form-control'],
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
                'required' => false
            ])
            ->setMethod('POST')
            ->setAction('/user/profile');
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'user_profile_form';
    }

    /**
     * @param array $options
     * @return User
     */
    public function getUser(array $options)
    {
        return $options['data']['user'];
    }
}
