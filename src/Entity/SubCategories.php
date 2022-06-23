<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\SubCategoriesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: SubCategoriesRepository::class)]
class SubCategories
{
    use CreatedAtTrait;
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'subCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private $categories;



    #[ORM\Column(type: 'string', length: 100)]
    private $objectname;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $lost_address;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $lost_codezip;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $lost_city;

    #[ORM\Column(type: 'date', nullable: true)]
    private $lost_date;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $owner_secondname;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $owner_firstname;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $owner_address;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $owner_codezip;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $owner_city;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $object_state;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $object_mark;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $object_model;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $object_color;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $object_material;

    #[ORM\Column(type: 'text')]
    private $object_description;

    #[ORM\Column(type: 'text', nullable: true)]
    private $object_clues;


    #[ORM\Column(type: 'boolean')]
    private $lost;


    #[ORM\ManyToOne(targetEntity: CategoriesDetails::class, inversedBy: 'subcategories')]
    private $categoriesdetails;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageobject;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'subCategories')]
    private $Users;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $active;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isfound;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }



    public function getObjectname(): ?string
    {
        return $this->objectname;
    }

    public function setObjectname(string $objectname): self
    {
        $this->objectname = $objectname;

        return $this;
    }

    public function getLostAddress(): ?string
    {
        return $this->lost_address;
    }

    public function setLostAddress(?string $lost_address): self
    {
        $this->lost_address = $lost_address;

        return $this;
    }

    public function getLostCodezip(): ?string
    {
        return $this->lost_codezip;
    }

    public function setLostCodezip(?string $lost_codezip): self
    {
        $this->lost_codezip = $lost_codezip;

        return $this;
    }

    public function getLostCity(): ?string
    {
        return $this->lost_city;
    }

    public function setLostCity(?string $lost_city): self
    {
        $this->lost_city = $lost_city;

        return $this;
    }

    public function getLostDate(): ?\DateTimeInterface
    {
        return $this->lost_date;
    }

    public function setLostDate(?\DateTimeInterface $lost_date): self
    {
        $this->lost_date = $lost_date;

        return $this;
    }

    public function getOwnerSecondname(): ?string
    {
        return $this->owner_secondname;
    }

    public function setOwnerSecondname(?string $owner_secondname): self
    {
        $this->owner_secondname = $owner_secondname;

        return $this;
    }

    public function getOwnerFirstname(): ?string
    {
        return $this->owner_firstname;
    }

    public function setOwnerFirstname(?string $owner_firstname): self
    {
        $this->owner_firstname = $owner_firstname;

        return $this;
    }

    public function getOwnerAddress(): ?string
    {
        return $this->owner_address;
    }

    public function setOwnerAddress(?string $owner_address): self
    {
        $this->owner_address = $owner_address;

        return $this;
    }

    public function getOwnerCodezip(): ?string
    {
        return $this->owner_codezip;
    }

    public function setOwnerCodezip(?string $owner_codezip): self
    {
        $this->owner_codezip = $owner_codezip;

        return $this;
    }

    public function getOwnerCity(): ?string
    {
        return $this->owner_city;
    }

    public function setOwnerCity(?string $owner_city): self
    {
        $this->owner_city = $owner_city;

        return $this;
    }

    public function getObjectState(): ?string
    {
        return $this->object_state;
    }

    public function setObjectState(?string $object_state): self
    {
        $this->object_state = $object_state;

        return $this;
    }

    public function getObjectMark(): ?string
    {
        return $this->object_mark;
    }

    public function setObjectMark(?string $object_mark): self
    {
        $this->object_mark = $object_mark;

        return $this;
    }

    public function getObjectModel(): ?string
    {
        return $this->object_model;
    }

    public function setObjectModel(?string $object_model): self
    {
        $this->object_model = $object_model;

        return $this;
    }

    public function getObjectColor(): ?string
    {
        return $this->object_color;
    }

    public function setObjectColor(?string $object_color): self
    {
        $this->object_color = $object_color;

        return $this;
    }

    public function getObjectMaterial(): ?string
    {
        return $this->object_material;
    }

    public function setObjectMaterial(?string $object_material): self
    {
        $this->object_material = $object_material;

        return $this;
    }

    public function getObjectDescription(): ?string
    {
        return $this->object_description;
    }

    public function setObjectDescription(string $object_description): self
    {
        $this->object_description = $object_description;

        return $this;
    }

    public function getObjectClues(): ?string
    {
        return $this->object_clues;
    }

    public function setObjectClues(?string $object_clues): self
    {
        $this->object_clues = $object_clues;

        return $this;
    }








    public function getLost(): ?bool
    {
        return $this->lost;
    }

    public function setLost(bool $lost): self
    {
        $this->lost = $lost;

        return $this;
    }



    public function getCategoriesdetails(): ?CategoriesDetails
    {
        return $this->categoriesdetails;
    }

    public function setCategoriesdetails(?CategoriesDetails $categoriesdetails): self
    {
        $this->categoriesdetails = $categoriesdetails;

        return $this;
    }

    public function getImageobject(): ?string
    {
        return $this->imageobject;
    }

    public function setImageobject(?string $imageobject): self
    {
        if (!is_null($imageobject)) {
            $this->imageobject = $imageobject;
        }
        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(?Users $Users): self
    {
        $this->Users = $Users;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getIsfound(): ?bool
    {
        return $this->isfound;
    }

    public function setIsfound(?bool $isfound): self
    {
        $this->isfound = $isfound;

        return $this;
    }
}
