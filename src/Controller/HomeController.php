<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController {
    
    /**
     * @var \Twig\Environment
     */
    /**
    private $twig;


    public function __construct(\Twig\Environment $twig) {
        $this->twig = $twig;
    }
    **/
    
    /**
     * @Route("/", name="home", options={"utf8": true})
     * @param PropertyRepository $repository
     * @return Response
     */
    
    public function index (PropertyRepository $repository) : Response
    {
        //return new Response($this->twig->render('pages/home.html.twig'));
        $properties = $repository->findLast();
        //dump($properties);
        
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
}

