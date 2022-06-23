<?php

namespace App\Controller;

use App\Entity\Objects;
use App\Form\AdLostType;
use App\Form\LostAdType;
use App\Entity\Categories;

use App\Entity\SubCategories;
use App\Form\AdLostTypeobject;


use App\Repository\SubCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;




class AdminController extends AbstractController
{
    #[Route('/user', name: 'app_admin'), IsGranted("ROLE_ADMIN"),]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    
}
