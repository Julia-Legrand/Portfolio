<?php

namespace App\Controller;

use App\Repository\AboutRepository;
use App\Repository\CareerRepository;
use App\Repository\SkillsRepository;
use App\Repository\ProjectsRepository;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(AboutRepository $aboutRepository, PresentationRepository $presentationRepository, SkillsRepository $skillsRepository, ProjectsRepository $projectsRepository, CareerRepository $careerRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
            'presentations' => $presentationRepository->findAll(),
            'skills' => $skillsRepository->findAll(),
            'projects' => $projectsRepository->findAll(),
            'careers' => $careerRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/admin', name: 'admin')]
    public function admin(AboutRepository $aboutRepository, PresentationRepository $presentationRepository, SkillsRepository $skillsRepository, ProjectsRepository $projectsRepository, CareerRepository $careerRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
            'presentations' => $presentationRepository->findAll(),
            'skills' => $skillsRepository->findAll(),
            'projects' => $projectsRepository->findAll(),
            'careers' => $careerRepository->findAll(),
        ]);
    }
}
