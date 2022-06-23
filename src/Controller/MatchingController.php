<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Users;
use App\Entity\Messages;
use App\Entity\SubCategories;
use Doctrine\ORM\Query\Expr\From;
use App\Form\MatchingMessagesType;
use App\Repository\UsersRepository;
use App\Repository\MessagesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\SubCategoriesRepository;
use Proxies\__CG__\App\Entity\Objects;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[
    Route('/user'),

    IsGranted("ROLE_USER"),
]
class MatchingController extends AbstractController
{
    #[Route('/matching', name: 'app_matching_trouver')]

    public function index(SubCategoriesRepository $subCategoriesRepository): Response
    {

        $objects = $subCategoriesRepository->findByUser($this->getUser());

        //1- mettre les categories d objects de lutilisateur  dans un tableau 
        $categoriesUser = [];
        foreach ($objects as $object) {
            array_push($categoriesUser, $object->getCategories());
        }
        //2 faire en sorte quil y aura pas de la repititions dans les categories 
        $categoriesUser = array_unique($categoriesUser);

        $objectsLost = [];
        foreach ($categoriesUser as $category) {
            // $categoriesdetails = $category->getCategoriesdetails();
            //3- creer une boucle  pour recuperer  tous les objects qui ont la meme categorie de user       
            $objectsOfCategory = $subCategoriesRepository->findByCategory($category, $this->getUser());
            //4 mettre ce qu' on a recupré dans un tableau 
            foreach ($objectsOfCategory as $obj) {
                array_push($objectsLost, $obj);
            }
        }
        //////////////////////////////////////////////////////////////////////////
        //1- mettre les categories d objects de lutilisateur  dans un tableau 
        $objectsD = $subCategoriesRepository->findByUser($this->getUser());
        $categoriesDetailsUser = [];
        foreach ($objectsD as $object) {
            array_push($categoriesDetailsUser, $object->getCategoriesdetails());
        }

        //2 faire en sorte quil y aura pas de la repititions dans les categories 
        $categoriesDetailsUser = array_unique($categoriesDetailsUser);


        $objectsdetailsLost = [];
        foreach ($categoriesDetailsUser as $categorydetails) {
            //3- creer une boucle  pour recuperer  tous les objects qui ont la meme categorie de user       
            $objectsOfCategorydetails = $subCategoriesRepository->findByDetailsCategory($categorydetails, $this->getUser());
            //4 mettre ce qu' on a recupré dans un tableau 

            foreach ($objectsOfCategorydetails as $obj) {
                array_push($objectsdetailsLost, $obj);
            }
        }


        $array1 = $objectsLost;
        $array2 = $objectsdetailsLost;
        $categoriesnodetails = array_diff($array1, $array2);




        //dd($categorienodetail);
        //////////////////////////////////////////////////////////////////////////
        //1- mettre les categories d objects de lutilisateur  dans un tableau 

        $objectsn = $subCategoriesRepository->findByUser($this->getUser());
        $objectNameUser = [];
        foreach ($objectsn as $object) {
            array_push($objectNameUser, $object->getobjectName());
        }

        //2 faire en sorte quil y aura pas de la repititions dans les categories 
        $objectNameUser = array_unique($objectNameUser);

        $objectsLostname = [];
        foreach ($objectNameUser as $objectname) {
            //3- creer une boucle  pour recuperer  tous les objects qui ont la meme categorie de user       
            $objectsOfobjectname = $subCategoriesRepository->findByobjectname($objectname, $this->getUser());
            //4 mettre ce qu' on a recupré dans un tableau 

            foreach ($objectsOfobjectname as $obj) {
                array_push($objectsLostname, $obj);
            }
        }
        // dd($objectsdetailsLost);
        $array1 = $objectsdetailsLost;
        $array2 =  $objectsLostname;
        $categoriesdetailsnoname = array_diff($array1, $array2);





        return $this->render('matching/index.html.twig', [
            'objectsLostOthersByCategories' => $categoriesnodetails,
            'objectsLostOthersByDetails' => $categoriesdetailsnoname,
            'objectsLostname' => $objectsLostname

        ]);
    }




    #[Route('/matching/{id}', name: 'matching_object_details')]
    public function Objectdetails(SubCategories $subcategories): Response
    {
        return $this->render('matching/matchingobjectdetails.html.twig', [

            'subcategories' => $subcategories,
        ]);
    }

    #[Route('/matching/send/{id}', name: 'app_messages_matching', methods: ['GET', 'POST'])]
    public function send(Request $request, MessagesRepository $messagesRepository, Users $users, SluggerInterface $slugger): Response
    {
        $message = new Messages();
        $form = $this->createForm(MatchingMessagesType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', 'Votre message a etait bien envoye');
            $message->setSender($this->getUser());
            $message->setRecipient($users);


            $imageobjet = $form->get('imagemessage')->getData();
            if ($imageobjet) {
                $originalFilename = pathinfo($imageobjet->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageobjet->guessExtension();
                try {
                    $imageobjet->move(
                        $this->getParameter('messageimage_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $message->setImagemessage($newFilename);
            }

            $messagesRepository->add($message);
            return $this->redirectToRoute('app_matching_trouver', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matching/matchingmessage.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }
}
