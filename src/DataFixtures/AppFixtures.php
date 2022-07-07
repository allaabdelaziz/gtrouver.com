<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use App\Entity\Messages;
use App\Entity\Categories;
use App\Entity\CategoriesDetails;
use App\Entity\SubCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger, private UserPasswordHasherInterface $passwordEnCode)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $categories = new Categories();
        $categories->setName('Portefeuille et CB & argent');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);




        $categories = new Categories();
        $categories->setName('Papiers et documents officiels');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);




        $categories = new Categories();
        $categories->setName('Sacs & Bagages');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);






        $categories = new Categories();
        $categories->setName('Bijoux, montres');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);



        $categories = new Categories();
        $categories->setName('vêtements et accessoires');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);


        $categories = new Categories();
        $categories->setName('Animaux');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);


        $categories = new Categories();
        $categories->setName('Effets personnels');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);


        $categories = new Categories();
        $categories->setName(' Divers');
        $categories->setSlug($this->slugger->slug($categories->getName())->lower());
        $manager->persist($categories);
        $manager->flush();


        //////////////////////////Categorydetails//////////////////////////

        $faker = Factory::create('fr_FR');
  
            $categoriesdetails = new CategoriesDetails();

            $categoriesdetails->setName("Portefeuille");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("CB");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);
            
            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Argent");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Papiers");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Documents officiels");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Sacs");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Bagages");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Bijoux");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("montres");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("vêtements");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("accessoires");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);
            
            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Chat");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);



            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Chien");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Clés, bips, badges");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Lunettes");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);


            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Objet non référencé");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Cosmétique");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Livre, papeterie");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Parapluie");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Canne de marche");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Médicaments");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);

            $categoriesdetails = new CategoriesDetails();
            $categoriesdetails->setName("Autre");
            $categoriesdetails->setCategory($categories);
            $manager->persist($categoriesdetails);






            $manager->flush();
       


        //////////////////////////SubCategory//////////////////////////

        {
            $faker = Factory::create('fr_FR');
            for ($su = 1; $su <= 15; $su++) {
                $subcategories = new SubCategories();

                $subcategories->setObjectName($faker->text(10));
                $subcategories->setLostAddress($faker->streetAddress);
                $subcategories->setLostCodezip(str_replace(' ', '', $faker->postcode));
                $subcategories->setLostCity($faker->city);
                $subcategories->setLostDate($faker->dateTimeBetween('-1 year', '+1 week'));
                $subcategories->setOwnerAddress($faker->streetAddress);
                $subcategories->setOwnerSecondName($faker->lastName);
                $subcategories->setOwnerFirstName($faker->firstName);
                $subcategories->setOwnerAddress($faker->address);
                $subcategories->setOwnerCodezip(str_replace(' ', '', $faker->postcode));
                $subcategories->setOwnerCity($faker->city);
                $subcategories->setObjectState($faker->text(8));
                $subcategories->setObjectMark($faker->text(6));
                $subcategories->setObjectModel($faker->text(10));
                $subcategories->setObjectColor($faker->colorName);
                $subcategories->setObjectMaterial($faker->text(6));
                $subcategories->setObjectDescription($faker->text);
                $subcategories->setObjectClues($faker->text);
                $subcategories->setObjectClues($faker->text);
                $subcategories->setSlug($this->slugger->slug($categoriesdetails->getName())->lower());
                $subcategories->setCategories($categories);
                $subcategories->setImageobject("public/images/cc.jpg");
                $subcategories->setCategoriesdetails($categoriesdetails);
                $subcategories->setLost($faker->randomElement([true, false]));
                $subcategories->setActive($faker->randomElement([true, false]));
                $subcategories->setIsfound($faker->randomElement([true, false]));


                $manager->persist($subcategories);



                $manager->flush();
            }
        }
        //////////////////////////////////Users//////////////////////////
        {
            $admin = new Users();
            $admin->setEmail('allaabdelazize@gmail.com');
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->passwordEnCode->hashPassword($admin, 'capilo09'));
            $admin->setSecondname('abdelaziz');
            $admin->setFirstName('alla');
            $admin->setAddress('14 avenue des chenes');
            $admin->setZipCode('91200');
            $admin->setCity('athismons');
            $admin->setphone('0615624270');
            $manager->persist($admin);


            $faker = Factory::create('fr_FR');
            for ($i = 1; $i <= 15; $i++) {
                $user = new Users();
                $user->setEmail($faker->email);
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($this->passwordEnCode->hashPassword($user, 'capilo09'));
                $user->setSecondname($faker->lastName);
                $user->setCivilite($faker->randomElement(['monsieur', 'madame']));
                $user->setFirstName($faker->firstName);
                $user->setAddress($faker->streetAddress);
                $user->setZipCode(str_replace(' ', '', $faker->postcode));
                $user->setCity($faker->city);
                $user->setphone($faker->phoneNumber);
                $manager->persist($user);

                $manager->flush();
            }
        }

        ///////////////////////messages//////////////////////////////////
        {

            $faker = Factory::create('fr_FR');
            for ($i = 1; $i <= 15; $i++) {
                $message = new Messages();
                $message->setSender($user);
                $message->setRecipient($user);

                $message->setConversationId($faker->numberBetween(1, 10));
                $message->setMessage($faker->text());

                $manager->persist($message);

                $manager->flush();
            }
        }

        ///////////////////////object//////////////////////////////////

    }
}
