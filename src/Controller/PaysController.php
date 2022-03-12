<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pays')]
class PaysController extends AbstractController
{
    #[Route('/', name: 'pays_index', methods: ['GET'])]
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('pays/index.html.twig', [
            'paysList' => $paysRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'pays_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pays);
            $entityManager->flush();

            return $this->redirectToRoute('pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pays/new.html.twig', [
            'pays' => $pays,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pays_show', methods: ['GET'])]
    public function show(Pays $pays): Response
    {
        return $this->render('pays/show.html.twig', [
            'pays' => $pays,
        ]);
    }

    #[Route('/{id}/edit', name: 'pays_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pays $pays, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pays/edit.html.twig', [
            'pays' => $pays,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pays_delete', methods: ['POST'])]
    public function delete(Request $request, Pays $pays, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pays->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pays);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pays_index', [], Response::HTTP_SEE_OTHER);
    }
}
