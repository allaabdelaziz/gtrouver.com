<?php

namespace App\Entity;


use App\Entity\Trait\CreatedAtTrait;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email')]

class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    use CreatedAtTrait;
 
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $civilite;

    #[ORM\Column(type: 'string', length: 100)]
    private $secondname;

    #[ORM\Column(type: 'string', length: 100)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 150)]
    private $address;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $zipcode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $phone;



    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Messages::class, orphanRemoval: true)]
    private $sendermessages;

    #[ORM\OneToMany(mappedBy: 'recipient', targetEntity: Messages::class, orphanRemoval: true)]
    private $recipientmessages;


    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'Users', targetEntity: SubCategories::class)]
    private $subCategories;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'users')]
    private $categories;

    public function __construct()
    {
        $this->sendermessages= new ArrayCollection();
        $this->recipientmessages = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->subCategories = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getSecondname(): ?string
    {
        return $this->secondname;
    }

    public function setSecondname(string $secondname): self
    {
        $this->secondname = $secondname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }



    /**
     * @return Collection<int, Messages>
     */
    public function getSendermessages(): Collection
    {
        return $this->sendermessages;
    }

    public function addSendermessage(Messages $sendermessage): self
    {
        if (!$this->sendermessages->contains($sendermessage)) {
            $this->sendermessages[] = $sendermessage;
            $sendermessage->setSender($this);
        }

        return $this;
    }

    public function removeSenderMessage(Messages $sendermessage): self
    {
        if ($this->sendermessages->removeElement($sendermessage)) {
            // set the owning side to null (unless already changed)
            if ($sendermessage->getSender() === $this) {
                $sendermessage->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getRecipientmessages(): Collection
    {
        return $this->recipientmessages;
    }

    public function addRecipientmessage(Messages $recipientmessage): self
    {
        if (!$this->recipientmessages->contains($recipientmessage)) {
            $this->recipientmessages[] = $recipientmessage;
            $recipientmessage->setRecipient($this);
        }

        return $this;
    }

    public function removeRecipientmessage(Messages $recipientmessage): self
    {
        if ($this->recipientmessages->removeElement($recipientmessage)) {
            // set the owning side to null (unless already changed)
            if ($recipientmessage->getRecipient() === $this) {
                $recipientmessage->setRecipient(null);
            }
        }

        return $this;
    }


    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $subCategory->setUsers($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategories $subCategory): self
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getUsers() === $this) {
                $subCategory->setUsers(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }


  
}
