<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\ProfileForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends Controller
{
    /**
     * @Route("/user/profile", name="user_profile")
     */
    public function profileAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(ProfileForm::class, ['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $user->setName($this->getName($request));

            if ($password = $this->getPassword($request, $user)) {
                $user->setPassword($password);
            }

            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Profile updated successfully!");

            return $this->redirectToRoute("user_profile");
        }

        return $this->render("frontend/default/user/profile.html.twig", [
            'profileForm' => $form->createView()
        ]);
    }

    protected function getPassword(Request $request, UserInterface $user)
    {
        $repeated = $this->getForm($request)['password'];

        $password = $repeated['first'] ?? null;

        if (empty($password)) {
            return null;
        }

        $encoder = new MessageDigestPasswordEncoder();

        return $encoder->encodePassword($password, $user->getSalt());
    }

    protected function getName(Request $request)
    {
        return $this->getForm($request)['name'] ?? null;
    }

    protected function getForm(Request $request)
    {
        return $request->get('user_profile_form');
    }
}