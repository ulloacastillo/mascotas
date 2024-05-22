<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Pet;
use AppBundle\Form\PetType;
use Exception;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
/**
 * @Route("/mascotas", name="pets.")
 */
class PetController extends Controller
{
    /**
     * @Route("/listar", name="getPets")
     */
    public function showAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            "SELECT m
            FROM AppBundle:Pet m"
        );
        $results = $query->getResult();
        dump($results);



        return $this->render("/mascotas/listar.html.twig", [
            'pets' => $results
        ]);
    }

    /**
     * @Route("/ingresar", name="addPet")
     */
    public function insertAction(Request $request)
    {
        $pet = new Pet();

        $form = $this->createForm(PetType::class, $pet);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pet = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            try {
                $entityManager->persist($pet);
                $entityManager->flush();
            }
            catch (Exception $e) {
                $this->addFlash('error', 'Error al Añadir Mascota');
                return $this->redirect($this->generateUrl('pets.addPet'));
            }

            $this->addFlash('success', 'Mascota Añadida');
            return $this->redirect($this->generateUrl('pets.getPets'));

        }

        return $this->render("/mascotas/ingresar.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modificar/{chip}", name="modifyPet")
     */
    public function modifyAction(Pet $pet)
    {

        return $this->render("/mascotas/modificar.html.twig", [
            'pet' => $pet
        ]);
    }

    /**
     * @Route("/eliminar/{chip}", name="removePet")
     */
    public function removeAction(Pet $pet)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($pet);
        $entityManager->flush();
        dump('hola');
        return $this->redirect($this->generateUrl('pets.getPets'));

    }
}

