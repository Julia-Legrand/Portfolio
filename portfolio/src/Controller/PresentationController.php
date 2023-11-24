<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/presentation')]
class PresentationController extends AbstractController
{
    #[Route('/', name: 'app_presentation_index', methods: ['GET'])]
    public function index(PresentationRepository $presentationRepository): Response
    {
        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentationRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presentation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presentation $presentation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('wallpaper')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '.' . $imageFile->guessExtension();
        
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
        
                $presentation->setWallpaper($newFilename);
            }
            $imageFile = $form->get('cv')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '.' . $imageFile->guessExtension();
        
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
        
                $presentation->setCv($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_presentation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }
}
