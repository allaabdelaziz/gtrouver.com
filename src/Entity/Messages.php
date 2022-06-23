<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\MessagesRepository;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    use SlugTrait;
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'sendermessages')]
    #[ORM\JoinColumn(nullable: false)]
    private $sender;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'recipientmessages')]
    #[ORM\JoinColumn(nullable: false)]
    private $recipient;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $conversation_id;

    #[ORM\Column(type: 'text')]
    private $message;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $title;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isread = 0  ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imagemessage;
    public function __construct()
    {
        
        $this->created_at = new \DateTimeImmutable();
    }
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?Users
    {
        return $this->sender;
    }

    public function setSender(?Users $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?Users
    {
        return $this->recipient;
    }

    public function setRecipient(?Users $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getConversationId(): ?int
    {
        return $this->conversation_id;
    }

    public function setConversationId(?int $conversation_id): self
    {
        $this->conversation_id = $conversation_id;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsread(): ?bool
    {
        return $this->isread;
    }

    public function setIsread(?bool $isread): self
    {
        $this->isread = $isread;

        return $this;
    }

    public function getImagemessage(): ?string
    {
        return $this->imagemessage;
    }

    public function setImagemessage(?string $imagemessage): self
    {
        $this->imagemessage = $imagemessage;

        return $this;
    }

    
}
