<?php
/**
 * Created by PhpStorm.
 * User: abdelmontet
 * Date: 2018-12-05
 * Time: 15:59
 */
namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;



class PropertyController extends AbstractController {

    private $repository;
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

     /**
      * @Route("/admin", name="admin.property.index")
      * @return Response
      */

    public function index() : Response
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }
    
    /**
     * @Route("admin/property/create", name="admin.property.add")
     * @param $request
     */
    
    public function add(Request $request) 
    {
        // on crée une class vide
        $property = new Property();
        // on crée un formulaire
        $form = $this->createForm(PropertyType::class, $property);
        // on passe la requete
        $form->handleRequest($request);
        
        // est-ce que le requete a été envoyée ? et est-ce que ce formulaire est validé ?
        if ($form->isSubmitted() && $form->isValid()){
            // Avant de flasher, on dit à em de persiter
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/property/new.html.twig", [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     */

    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        
        // on passe la requete
        $form->handleRequest($request);
        
        // est-ce que le requete a été envoyée ? et est-ce que ce formulaire est validé ?
        if ($form->isSubmitted() && $form->isValid()){
            // Execution requete BD
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/property/edit.html.twig", [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
    */
    
    function delete(Property $property, Request $request) 
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))){
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.property.index');
    }
}