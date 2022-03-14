<?php

namespace App\Controller;

use App\Entity\SpecialiteComplementaire;
use App\Form\SpecialiteComplementaireType;
use App\Repository\SpecialiteComplementaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/specialite_complementaires')]
#[IsGranted('ROLE_ADMIN')]
class SpecialiteComplementaireController extends AbstractController
{
    #[Route('/', name: 'specialite_complementaire_index', methods: ['GET'])]
    public function index(SpecialiteComplementaireRepository $specialiteComplementaireRepository): Response
    {
        return $this->render('specialite_complementaire/index.html.twig', [
            'specialite_complementaires' => $specialiteComplementaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'specialite_complementaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $specialiteComplementaire = new SpecialiteComplementaire();
        $form = $this->createForm(SpecialiteComplementaireType::class, $specialiteComplementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($specialiteComplementaire);
            $entityManager->flush();

            return $this->redirectToRoute('specialite_complementaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('specialite_complementaire/new.html.twig', [
            'specialite_complementaire' => $specialiteComplementaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'specialite_complementaire_show', methods: ['GET'])]
    public function show(SpecialiteComplementaire $specialiteComplementaire): Response
    {
        return $this->render('specialite_complementaire/show.html.twig', [
            'specialite_complementaire' => $specialiteComplementaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'specialite_complementaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SpecialiteComplementaire $specialiteComplementaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SpecialiteComplementaireType::class, $specialiteComplementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('specialite_complementaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('specialite_complementaire/edit.html.twig', [
            'specialite_complementaire' => $specialiteComplementaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'specialite_complementaire_delete', methods: ['POST'])]
    public function delete(Request $request, SpecialiteComplementaire $specialiteComplementaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialiteComplementaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($specialiteComplementaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('specialite_complementaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
