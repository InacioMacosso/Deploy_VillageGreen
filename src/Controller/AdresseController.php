<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adresse")
 */
class AdresseController extends AbstractController
{
    /**
     * @Route("/", name="adresse_index", methods={"GET"})
     */
    public function index(): Response
    {
        $adresses = $this->getDoctrine()
            ->getRepository(Adresse::class)
            ->findAll();

        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresses,
        ]);
    }

    /**
     * @Route("/new", name="adresse_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user= $this->getUser();
            $adresse->setAdresseClientId($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adresse);
            $entityManager->flush();
            $this->addFlash('adresse_message','Votre adresse a été enregistrée');
            return $this->redirectToRoute('compte');
        }

        return $this->render('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{adresseId}/edit", name="adresse_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Adresse $adresse
     * @return Response
     */
    public function edit(Request $request, Adresse $adresse): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('adresse_message','Votre adresse a été modifiée');
            return $this->redirectToRoute('compte');
        }

        return $this->render('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{adresseId}", name="adresse_delete", methods={"POST"})
     * @param Request $request
     * @param Adresse $adresse
     * @return Response
     */
    public function delete(Request $request, Adresse $adresse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getAdresseId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adresse);
            $entityManager->flush();
            $this->addFlash('adresse_message','Votre adresse a été suprimée');
        }

        return $this->redirectToRoute('compte');
    }
}
