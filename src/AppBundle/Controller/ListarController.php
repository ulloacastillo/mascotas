<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;




class ListarController extends Controller
{
    /**
     * @Route("/mascotas/listar", name="listarMascotas")
     */
    public function showAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            "SELECT m
            FROM AppBundle:Mascota m"
        );
        $results = $query->getResult();
        dump($results);

        return $this->render("/mascotas/listar.html.twig", [
            'pets' => $results, 
            'successMessage' => null
        ]);
    }
}
