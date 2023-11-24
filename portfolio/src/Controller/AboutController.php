<?php

namespace App\Controller;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/about')]
class AboutController extends AbstractController
{
    #[Route('/', name: 'app_about_index', methods: ['GET'])]
    public function index(AboutRepository $aboutRepository): Response
    {
        return $this->render('about/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_about_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, About $about, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('aboutPicture')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
        
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
        
                $about->setAboutPicture($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('about/edit.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }
}
