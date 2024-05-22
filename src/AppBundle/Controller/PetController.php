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
use AppBundle\Entity\Mascota;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
/**
 * @Route("/mascotas", name="mascota.")
 */
class PetController extends Controller
{
    /**
     * @Route("/listar", name="listarMascotas")
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
            'pets' => $results
        ]);
    }

    /**
     * @Route("/ingresar", name="ingresarMascotas")
     */
    public function insertAction(Request $request)
    {
        $mascota = new Mascota();

        $form = $this->createFormBuilder($mascota)
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
            $mascota = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mascota);
            $entityManager->flush();

            $query = $entityManager->createQuery(
                "SELECT m
                FROM AppBundle:Mascota m"
            );
            $results = $query->getResult();
            $this->addFlash('success', 'Mascota Añadida');

            return $this->redirect($this->generateUrl('listarMascotas'));

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
     * @Route("/modificar", name="modificarMascotas")
     */
    public function modifyAction(Request $request)
    {

        return $this->render("/mascotas/modificar.html.twig");
    }
}

