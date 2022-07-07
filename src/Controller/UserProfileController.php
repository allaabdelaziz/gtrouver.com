<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserType;
use App\Form\EditObjectType;
use Doctrine\ORM\Mapping\Id;
use App\Entity\SubCategories;
use App\Form\DeleteObjectType;
use App\Repository\UsersRepository;
use App\Form\ChangePasswordFormType;
use App\Repository\CategoriesRepository;
use App\Repository\SubCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[
    Route('/user'),
    IsGranted("ROLE_USER"),
]
class UserProfileController extends AbstractController
{

    #[Route('/newobject', name: 'app_annonce_adloser', methods: ['GET', 'POST'])]
    public function newobject(Request $request, SubCategoriesRepository  $subCategoriesRepository,CategoriesRepository $categoriesRepository, SluggerInterface $slugger): Response
    {
       
        $subCategory = new SubCategories();
        ;
        $form = $this->createForm(AdLostType::class, $subCategory );
        
        $form->handleRequest($request);
        // dd( $form); 

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->addFlash('success', 'vous avez ajouter un new object');
            $subCategory->setUsers($this->getUser());
            $subCategory->setIsFound(false);
            $subCategory->setActive(true);
            
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
                }
                $subCategory->setImageobject($newFilename);
            }
            $subCategoriesRepository->add($subCategory);
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('annonce/adloser.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
            'categories'=>$categoriesRepository->findAll(),
        ]);
      
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/profile/object', name: 'app_user_profile_object')]
    public function userObject(UsersRepository $usersRepository, SubCategoriesRepository $subCategorieRepository): Response
    {
        $findObjects= $subCategorieRepository->findByUser( $this->getUser());
        $lostObjects= $subCategorieRepository->lostByUser( $this->getUser());
        return $this->render('user_profile/profileobject.html.twig', [
            'users' => $usersRepository->findAll(),
                'objectsFound' =>  $findObjects,
                'objectsLost' =>  $lostObjects,
        ]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/profile/object/{id}', name: 'user_object_details')]
    public function Objectdetails(SubCategories $subcategories): Response
    {
        return $this->render('user_profile/objectdetails.html.twig', [
            'controller_name' => 'UserProfileController',
            'subcategories' => $subcategories,
        ]);
    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////


    #[Route('/object/edit/{id}', name: 'app_object_edit', methods: ['GET', 'POST'])]
    public function editobject(Request $request, SubCategoriesRepository $subCategoriesRepository, SluggerInterface $slugger, SubCategories $subCategory): Response
    {

        $form = $this->createForm(EditObjectType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategory->setUsers($this->getUser());
            $subCategory->setIsFound(false);
            $subCategory->setActive(true);
          
            $imageobjet = $form->get('imageobject')->getData();
            if ($imageobjet !== null) {
                $originalFilename = pathinfo($imageobjet->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageobjet->guessExtension();
                try {
                    $imageobjet->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $subCategory->setImageobject($newFilename);
            }
            $subCategoriesRepository->add($subCategory);
         

            return $this->redirectToRoute('app_user_profile_object', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('annonce/adloseredit.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
        ]);
    }
 //////////////////////////////////////////////////////////////////////////////////////////////////////


    #[Route('/object/delete/{id}', name: 'app_object_delete', methods: ['GET', 'POST'])]
    public function deleteobject(Request $request, SubCategoriesRepository $subCategoriesRepository, SubCategories $subCategory): Response
    {

        $form = $this->createForm(DeleteObjectType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategory->setUsers($this->getUser());
       
        $subCategoriesRepository->add($subCategory);
    

        return $this->redirectToRoute('app_user_profile_object', [], Response::HTTP_SEE_OTHER);
    }
        return $this->renderForm('annonce/adloserdelete.html.twig', [
            'sub_category' => $subCategory,
            'form' => $form,
        ]);
    }



 //////////////////////////////////////////////////////////////////////////////////////////////////////


    #[Route('/profile', name: 'app_user_profile')]
    public function profile(UsersRepository $usersRepository): Response
    {
        return $this->render('user_profile/userprofile.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    #[Route(' profile/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function editprofile(Request $request, Users $user, UsersRepository $usersRepository): Response
    {


        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->add($user);
            return $this->redirectToRoute('app_user_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_profile/edituserprofile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/reset/{id}', name: 'app_reset_password_profile')]
    public function reset(Request $request, UserPasswordHasherInterface $userPasswordHasher, Users $user, UsersRepository $usersRepository): Response
    {

        // The token is valid; allow the user to change their password.
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre mot de passe a été modifié');

            $encodedPassword = $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            $user->setPassword($encodedPassword);
            $usersRepository->add($user);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('user_profile/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }

  
}
