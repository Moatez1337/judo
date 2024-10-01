<?php

namespace App\Controller;

use App\Repository\TechniqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TechniqueListingController extends AbstractController
{
    private TechniqueRepository $techniqueRepository;
    public function __construct(TechniqueRepository $techniqueRepository)
    {
        $this->techniqueRepository = $techniqueRepository;
    }
    #[Route('/technique/listing', name: 'app_technique_listing')]
    public function index(): Response
    {
        $techniques = $this->techniqueRepository->findAll();
        return $this->render('technique_listing/index.html.twig', [
            'techniques' => $techniques,
        ]);
    }
}
