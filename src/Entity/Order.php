<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Table $table_order = null;

    #[ORM\OneToMany(mappedBy: 'order_desc', targetEntity: OrderDescription::class)]
    private Collection $orderDescriptions;

    public function __construct()
    {
        $this->orderDescriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTableOrder(): ?Table
    {
        return $this->table_order;
    }

    public function setTableOrder(?Table $table_order): static
    {
        $this->table_order = $table_order;

        return $this;
    }

    /**
     * @return Collection<int, OrderDescription>
     */
    public function getOrderDescriptions(): Collection
    {
        return $this->orderDescriptions;
    }

    public function addOrderDescription(OrderDescription $orderDescription): static
    {
        if (!$this->orderDescriptions->contains($orderDescription)) {
            $this->orderDescriptions->add($orderDescription);
            $orderDescription->setOrderDesc($this);
        }

        return $this;
    }

    public function removeOrderDescription(OrderDescription $orderDescription): static
    {
        if ($this->orderDescriptions->removeElement($orderDescription)) {
            // set the owning side to null (unless already changed)
            if ($orderDescription->getOrderDesc() === $this) {
                $orderDescription->setOrderDesc(null);
            }
        }

        return $this;
    }
}
