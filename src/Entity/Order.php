<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /** @phpstan-ignore-next-line*/
    private int $id;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'boolean')]
    private bool $status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $sendImage;

    #[ORM\OneToMany(mappedBy: 'orderEntity', targetEntity: OrderLineItem::class, orphanRemoval: true)]
    private Collection $orderLineItems;

    #[ORM\OneToOne(targetEntity: Recipient::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $recipient;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $company;


    public function __construct()
    {
        $this->orderLineItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSendImage(): ?string
    {
        return $this->sendImage;
    }

    public function setSendImage(?string $sendImage): self
    {
        $this->sendImage = $sendImage;

        return $this;
    }

    /**
     * @return Collection|OrderLineItem[]
     */
    public function getOrderLineItems(): Collection
    {
        return $this->orderLineItems;
    }

    public function addOrderLineItem(OrderLineItem $orderLineItem): self
    {
        if (!$this->orderLineItems->contains($orderLineItem)) {
            $this->orderLineItems[] = $orderLineItem;
            $orderLineItem->setOrderEntity($this);
        }

        return $this;
    }

    public function removeOrderLineItem(OrderLineItem $orderLineItem): self
    {
        if ($this->orderLineItems->removeElement($orderLineItem)) {
            // set the owning side to null (unless already changed)
            if ($orderLineItem->getOrderEntity() === $this) {
                $orderLineItem->setOrderEntity(null);
            }
        }

        return $this;
    }

    public function getRecipient(): ?Recipient
    {
        return $this->recipient;
    }

    public function setRecipient(Recipient $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

}
