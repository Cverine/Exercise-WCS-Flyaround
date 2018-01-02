<?php

namespace WCS\CoavBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends Controller
{

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('/');
        }
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('public/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $flights = $em->getRepository("WCSCoavBundle:Flight")->findLastFlights();
        $models = $em->getRepository("WCSCoavBundle:PlaneModel")->findLastModels();
        $terrains = $em->getRepository("WCSCoavBundle:Terrain")->findLastTerrains();
        return $this->render('WCSCoavBundle:Default:index.html.twig', [
            "flights" => $flights,
            "models"  => $models,
            "terrains"=> $terrains
        ]);
    }



}