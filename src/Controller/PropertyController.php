<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;


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
    
    public function index(PaginatorInterface $paginator, Request $request) : Response
    {
        // 1. on crée un objet contenant une entité PropertySearch vide
        $search = new PropertySearch;
        
        // 2. On crée un formulaire correspondant
        $form = $this->createForm(PropertySearchType::class, $search);
        
        // 3. On précise qu'il doit gérér la requête
        $form->handleRequest($request);
        
        $properties = $paginator->paginate(
                $this->repository->findAllVisibleQuery($search),
                $request->query->getInt('page', 1),
                12
                );
        
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            // 4. on envoie le formulaire à la vue
            'form' => $form->createView()
            
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

