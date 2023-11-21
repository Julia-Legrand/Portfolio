<?php

namespace App\Controller;

use App\Entity\Career;
use App\Form\CareerType;
use App\Repository\CareerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/career')]
class CareerController extends AbstractController
{
    #[Route('/', name: 'app_career_index', methods: ['GET'])]
    public function index(CareerRepository $careerRepository): Response
    {
        return $this->render('career/index.html.twig', [
            'careers' => $careerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_career_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $career = new Career();
        $form = $this->createForm(CareerType::class, $career);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($career);
            $entityManager->flush();

            return $this->redirectToRoute('app_career_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('career/new.html.twig', [
            'career' => $career,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_career_show', methods: ['GET'])]
    public function show(Career $career): Response
    {
        return $this->render('career/show.html.twig', [
            'career' => $career,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_career_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Career $career, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CareerType::class, $career);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_career_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('career/edit.html.twig', [
            'career' => $career,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_career_delete', methods: ['POST'])]
    public function delete(Request $request, Career $career, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$career->getId(), $request->request->get('_token'))) {
            $entityManager->remove($career);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_career_index', [], Response::HTTP_SEE_OTHER);
    }
}
