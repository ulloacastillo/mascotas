<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Pet;
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

        $form = $this->createFormBuilder($pet)
            ->add('chip', IntegerType::class)
            ->add('tipo', IntegerType::class)
            ->add('nombre', TextType::class)
            ->add('sexo', CheckboxType::class)
            ->add('color', TextType::class)
            ->add('fecha_nacimiento', DateType::class)
            ->add('raza', TextType::class)
            ->add('estirilizada', CheckboxType::class)
            ->add('rut', TextType::class)
            ->add('rut', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Añadir Mascota'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $pet = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pet);
            $entityManager->flush();

            $query = $entityManager->createQuery(
                "SELECT m
                FROM AppBundle:Pet m"
            );
            $results = $query->getResult();
            $this->addFlash('success', 'Mascota Añadida');

            return $this->redirect($this->generateUrl('pets.getPets'));

            // return $this->render("/mascotas/listar.html.twig",
            //     [
            //         'successMessage' => "mascota fue añadida",
            //         'pets' => $results,
            //     ]
            // );
        }

        return $this->render("/mascotas/ingresar.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modificar", name="modifyPet")
     */
    public function modifyAction(Request $request)
    {

        return $this->render("/mascotas/modificar.html.twig");
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

