<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\CategoriesDetails;
use App\Entity\SubCategories;
use App\Form\SubCategoriesType;
use App\Repository\SubCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[
    Route('/admin/subcategories'),

]

class SubCategoriesController extends AbstractController
{
    #[Route('/', name: 'app_sub_categories_index', methods: ['GET'])]
    public function index(SubCategoriesRepository $subCategoriesRepository): Response
    {
        return $this->render('sub_categories/index.html.twig', [
            'sub_categories' => $subCategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sub_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SubCategoriesRepository $subCategoriesRepository, SluggerInterface $slugger): Response
    {
        $categoriesdetails = new CategoriesDetails;
        $subCategory = new SubCategories();
        $categories = new Categories;
        $form = $this->createForm(SubCategoriesType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategory->setUsers($this->getUser());
            $subCategory->setCategories($categories);
            $subCategory->setCategoriesdetails($categoriesdetails);
            dd($subCategory);
            $imageobjet = $form->get('imageobject')->getData();
            if ($imageobjet) {
                $originalFilename = pathinfo($imageobjet->getClientOriginalName(), PATHINFO_FILENAME);
               
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageobjet->guessExtension();

                try {
                    $imageobjet->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                }
                $subCategory->setImageobject($newFilename);
            }
            $subCategoriesRepository->add($subCategory);
            return $this->redirectToRoute('app_sub_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sub_categories/new.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sub_categories_show', methods: ['GET'])]
    public function show(SubCategories $subCategory): Response
    {
        return $this->render('sub_categories/show.html.twig', [
            'sub_category' => $subCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sub_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SubCategories $subCategory, SubCategoriesRepository $subCategoriesRepository): Response
    {
        $form = $this->createForm(SubCategoriesType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategoriesRepository->add($subCategory);
            return $this->redirectToRoute('app_sub_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sub_categories/edit.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sub_categories_delete', methods: ['POST'])]
    public function delete(Request $request, SubCategories $subCategory, SubCategoriesRepository $subCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $subCategory->getId(), $request->request->get('_token'))) {
            $subCategoriesRepository->remove($subCategory);
        }

        return $this->redirectToRoute('app_sub_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
