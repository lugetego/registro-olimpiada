<?php

namespace App\Controller;

use App\Entity\Estudiante;
use App\Form\EstudianteType;
use App\Repository\EstudianteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/estudiante")
 */
class EstudianteController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="estudiante_index", methods={"GET"})
     */
    public function index(EstudianteRepository $estudianteRepository): Response
    {
        return $this->render('estudiante/index.html.twig', [
            'estudiantes' => $estudianteRepository->findAll(),
        ]);
    }

    private $manager;

    public function __construct(UserManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/new", name="estudiante_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $estudiante = new Estudiante();
        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->remove('puntuacion');
        $user = $this->manager->findUserByUsername('enlinea');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estudiante->setCoordinador($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estudiante);
            $entityManager->flush();

            // Correo electrónico
            $message = (new \Swift_Message('Olimpiada Michoacana de Matemáticas - Registro'))
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($estudiante->getMail() ))
//            ->setTo('gerardo@matmor.unam.mx')
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('estudiante/mail-confirmacion.txt.twig', array('estudiante' => $estudiante)));
            ;
            $mailer->send($message);

           // return $this->redirectToRoute('estudiante_index');
            return $this->render('estudiante/confirmacion-registro.html.twig', [
                'estudiante' => $estudiante,
            ]);
        }

        return $this->render('estudiante/new.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{slug}", name="estudiante_show", methods={"GET"})
     */
    public function show(Estudiante $estudiante): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('estudiante/show.html.twig', [
            'estudiante' => $estudiante,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="estudiante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estudiante $estudiante): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(EstudianteType::class, $estudiante);
        $form->handleRequest($request);
        $user = $this->getUser();


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coordinador_index');
        }

        return $this->render('estudiante/edit.html.twig', [
            'estudiante' => $estudiante,
            'form' => $form->createView(),
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/{slug}", name="estudiante_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estudiante $estudiante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estudiante->getSlug(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estudiante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coordinador_index');
    }
}
