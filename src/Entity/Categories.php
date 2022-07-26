<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{

    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    
    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: SubCategories::class, orphanRemoval: true)]
    private $subCategories;

    #[ORM\OneToMany(mappedBy: 'categoriesdetails', targetEntity: CategoriesDetails::class)]
    private $categoriesDetails;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'categories')]
    private $users;

   

    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->categoriesDetails = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id =$id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

   
    /**
     * @return Collection<int, SubCategories>
     */
    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(SubCategories $subCategory): self
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories[] = $subCategory;
            $subCategory->setCategories($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategories $subCategory): self
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getCategories() === $this) {
                $subCategory->setCategories(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, CategoriesDetails>
     */
    public function getCategoriesDetails(): Collection
    {
        return $this->categoriesDetails;
    }

    public function addCategoriesDetail(CategoriesDetails $categoriesDetail): self
    {
        if (!$this->categoriesDetails->contains($categoriesDetail)) {
            $this->categoriesDetails[] = $categoriesDetail;
            $categoriesDetail->setCategory($this);
        }

        return $this;
    }

    public function removeCategoriesDetail(CategoriesDetails $categoriesDetail): self
    {
        if ($this->categoriesDetails->removeElement($categoriesDetail)) {
            // set the owning side to null (unless already changed)
            if ($categoriesDetail->getCategory() === $this) {
                $categoriesDetail->setCategory(null);
            }
        }

        return $this;
    }
     public function __toString() {
         return $this->id;
    }

     /**
      * @return Collection<int, Users>
      */
     public function getUsers(): Collection
     {
         return $this->users;
     }

     public function addUser(Users $user): self
     {
         if (!$this->users->contains($user)) {
             $this->users[] = $user;
             $user->addCategory($this);
         }

         return $this;
     }

     public function removeUser(Users $user): self
     {
         if ($this->users->removeElement($user)) {
             $user->removeCategory($this);
         }

         return $this;
     }

 
}
