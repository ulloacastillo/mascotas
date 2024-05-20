<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ModificarController extends Controller
{
    /**
     * @Route("/mascotas/modificar", name="modificarMascotas")
     */
    public function mascotasAction(Request $request)
    {

        return $this->render("/mascotas/modificar.html.twig");
    }
}
