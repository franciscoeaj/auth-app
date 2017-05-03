<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/api/user/authenticate", name="user.authenticate")
     */
    public function authenticate(Request $request)
    {
        $r = new Response();

        if ($request->getMethod() == 'POST') {
            $content = $request->getContent();
            $json = json_decode($content, true);
            $email = $json['email'];
            $password = $json['password'];
            // $email = $request->request->get('email');
            // $password = $request->request->get('password');

            $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');
            $user = $userRepository->findOneBy(['email' => $email, 'password' => $password]);

            if (is_object($user)) {
                $r->setContent(json_encode(['id' => $user->getId(), 'name' => $user->getName(), 'email' => $user->getEmail()])); 
            } else {
                $r->setContent('This user does not exist');
            }
        } else {
            $r->setContent('Method not allowed');
        }      

        return $r;
    }
}