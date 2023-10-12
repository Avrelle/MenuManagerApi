<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlateRepository::class)]
#[ApiResource]
class Plate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'plates')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToMany(targetEntity: OrderDescription::class, mappedBy: 'plate')]
    private Collection $orderDescriptions;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'plate')]
    private Collection $menus;

    public function __construct()
    {
        $this->orderDescriptions = new ArrayCollection();
        $this->menus = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $orderDescription->addPlate($this);
        }

        return $this;
    }

    public function removeOrderDescription(OrderDescription $orderDescription): static
    {
        if ($this->orderDescriptions->removeElement($orderDescription)) {
            $orderDescription->removePlate($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): static
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
            $menu->addPlate($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): static
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removePlate($this);
        }

        return $this;
    }

}