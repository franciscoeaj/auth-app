<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
    /**
     * @Route("/api/user/authenticate", name="user.authenticate")
     */
    public function authenticate(Request $request)
    {
        $r = new Response();

        $content = $request->getContent();
        $json = json_decode($content, true);
        $email = $json['email'];
        $password = $json['password'];

        $r->setContent(json_encode(['email' => $email, 'password' => $password]));

        return $r;
    }
}