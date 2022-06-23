<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\ContactType;
use App\Repository\MessagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/conditions-utilisateurs', name: 'app_conditions', methods: ['GET', 'POST'])]
    public function conditions(): Response
    {

        return $this->render('home/conditionsU.html.twig', []);
    }


    #[Route('/politique-confidentialite', name: 'app_confidentialite', methods: ['GET', 'POST'])]
    public function contact(): Response
    {

        return $this->render('home/confidentialite.html.twig', []);
    }








    
}
