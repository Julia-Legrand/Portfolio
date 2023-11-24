<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AboutRepository;
use App\Repository\CareerRepository;
use App\Repository\SkillsRepository;
use App\Repository\ContactRepository;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, AboutRepository $aboutRepository, PresentationRepository $presentationRepository, SkillsRepository $skillsRepository, ProjectsRepository $projectsRepository, CareerRepository $careerRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'contact' => $contact,
            'form' => $form,
            'abouts' => $aboutRepository->findAll(),
            'presentations' => $presentationRepository->findAll(),
            'skills' => $skillsRepository->findAll(),
            'projects' => $projectsRepository->findAll(),
            'careers' => $careerRepository->findAll(),  
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/admin', name: 'admin')]
    public function admin(AboutRepository $aboutRepository, PresentationRepository $presentationRepository, SkillsRepository $skillsRepository, ProjectsRepository $projectsRepository, CareerRepository $careerRepository, ContactRepository $contactRepository): Response
    {
        return $this->render('main/admin.html.twig', [
            'abouts' => $aboutRepository->findAll(),
            'presentations' => $presentationRepository->findAll(),
            'skills' => $skillsRepository->findAll(),
            'projects' => $projectsRepository->findAll(),
            'careers' => $careerRepository->findAll(),
            'contacts' => $contactRepository->findAll(),
        ]);
    }

    #[Route('/politique-de-confidentialite', name: 'confid')]
    public function confid(): Response
    {
        return $this->render('main/confid.html.twig');
    }

    #[Route('/mentions-legales', name: 'legals')]
    public function legals(): Response
    {
        return $this->render('main/legals.html.twig');
    }
}
