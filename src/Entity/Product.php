<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /** @phpstan-ignore-next-line*/
    private $id;

    #[Groups(["product","company"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cover;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $company;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderLineItem::class, orphanRemoval: true)]
    private $orderLineItems;


    public function __construct()
    {
        $this->orderLineItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

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
            $orderLineItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderLineItem(OrderLineItem $orderLineItem): self
    {
        if ($this->orderLineItems->removeElement($orderLineItem)) {
            // set the owning side to null (unless already changed)
            if ($orderLineItem->getProduct() === $this) {
                $orderLineItem->setProduct(null);
            }
        }

        return $this;
    }

}
