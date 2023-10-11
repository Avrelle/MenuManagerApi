<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToMany(targetEntity: OrderDescription::class, inversedBy: 'menus')]
    private Collection $menu_order;

    #[ORM\ManyToMany(targetEntity: Plate::class, inversedBy: 'menus')]
    private Collection $plate;

    public function __construct()
    {
        $this->menu_order = new ArrayCollection();
        $this->plate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, OrderDescription>
     */
    public function getMenuOrder(): Collection
    {
        return $this->menu_order;
    }

    public function addMenuOrder(OrderDescription $menuOrder): static
    {
        if (!$this->menu_order->contains($menuOrder)) {
            $this->menu_order->add($menuOrder);
        }

        return $this;
    }

    public function removeMenuOrder(OrderDescription $menuOrder): static
    {
        $this->menu_order->removeElement($menuOrder);

        return $this;
    }

    /**
     * @return Collection<int, Plate>
     */
    public function getPlate(): Collection
    {
        return $this->plate;
    }

    public function addPlate(Plate $plate): static
    {
        if (!$this->plate->contains($plate)) {
            $this->plate->add($plate);
        }

        return $this;
    }

    public function removePlate(Plate $plate): static
    {
        $this->plate->removeElement($plate);

        return $this;
    }
}