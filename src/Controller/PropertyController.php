<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController {
    
    /**
     * @var PropertyRepository
     */
    
    private $repository;
    private $em;


    public function __construct(PropertyRepository $repository, ObjectManager $em) {
        
        $this->repository = $repository;
        $this->em = $em;
        
    }




    /**
     * @Route("/biens", name="property.index", options={"utf8": true})
     * @return Response
     */
    
    public function index() : Response
    {
        /** 
         * Inserer 1 enregistrement
        $property = new Property();
        $property->setTitle('Mon premier bien')
                 ->setPrice(20000)
                 ->setRooms(4)
                 ->setBedrooms(3)
                 ->setDescription('une petite description')
                 ->setSurface(60)
                 ->setFloor(4)
                 ->setHeat(1)
                 ->setCity('Montpellier')
                 ->setAdress('15 boulevard Gambetta')
                 ->setPostalCode('34000');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();
        **/ 
        
        /** 1ere méthode d'appeler une repository **
        $repository = $this->getDoctrine()->getRepository(Property::class);
        dump($repository);
         * 
         */
        /** 1 bien 
            $property = $this->repository->find(1);
         */
        /* Tous les biens  
            $property = $this->repository->findAll();
            dump($property);
         */
        /* Recherche par tableau 
            $property = $this->repository->findOneBy(['floor' => 4]);
        */
        
        /* Met a jour l'attribut Sold 
        $property = $this->repository->findAll();
        $property[0]->setSold(false);
        $this->em->flush();
        */
        
        /* Tous les biens ne sont pas vendus */
        $properties = $this->repository->findAllVisible();
        
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
            
        ]);
    }
    
    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug" : "[a-zA-Z1-9\-_\/]+", "id" : "\d+"})
     * @param Property $property
     * @param string $slug
     * @return Response
     */
    public function show(Property $property, string $slug) : Response
    {
        //$property = $this->repository->find($id);
        $property_slug = $property->getSlug();
        if ($property_slug !== $slug)
        {
            return $this->redirectToRoute('property.show' , [
                'id' => $property->getId(),
                'slug' => $property_slug
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }
}

