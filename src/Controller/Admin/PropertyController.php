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



class PropertyController extends AbstractController {

    private $repository;

    public function __construct(PropertyRepository $repository)
    {

        $this->repository = $repository;
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
     * @Route("admin/{id}/edit", name="admin.property.edit")
     * @param $property
     * @return Response
     */

    public function edit(Property $property) : Response
    {
        return $this->render("admin/property/edit.html.twig", compact('property'));
    }


}