<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Estudiante;
use App\Form\EstudianteType;
use App\Repository\EstudianteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coordinador")
 */
class CoordinadorController extends AbstractController
{
    /**
     * @Route("/", name="coordinador_index", methods={"GET"})
     */
    public function index(EstudianteRepository $estudianteRepository): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('coordinador/index.html.twig', [
            'estudiantes' => $estudianteRepository->findByCoordinador($user),
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/estudiante", name="coordinador_estudiante", methods={"GET","POST"})
     */
    public function newEstudiante(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $estudiante = new Estudiante();
        $user = $this->getUser();
        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estudiante->setCoordinador($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estudiante);
            $entityManager->flush();

            return $this->redirectToRoute('coordinador_index');
        }

        return $this->render('coordinador/estudiante.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
            'user'=>$user,
        ]);
    }

//    /**
//     * @Route("/{id}", name="estudiante_show", methods={"GET"})
//     */
//    public function show(Estudiante $estudiante): Response
//    {
//        return $this->render('estudiante/show.html.twig', [
//            'estudiante' => $estudiante,
//        ]);
//    }

//    /**
//     * @Route("/{id}/edit", name="estudiante_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Estudiante $estudiante): Response
//    {
//        $form = $this->createForm(EstudianteType::class, $estudiante);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('estudiante_index');
//        }
//
//        return $this->render('estudiante/edit.html.twig', [
//            'estudiante' => $estudiante,
//            'form' => $form->createView(),
//        ]);
//    }

//    /**
//     * @Route("/{id}", name="estudiante_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, Estudiante $estudiante): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$estudiante->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($estudiante);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('estudiante_index');
//    }
}
