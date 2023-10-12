<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderDescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: OrderDescriptionRepository::class)]
#[ApiResource]
class OrderDescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDescriptions')]
    private ?Order $order_desc = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'menu_order')]
    private Collection $menus;

    #[ORM\ManyToMany(targetEntity: Plate::class, inversedBy: 'orderDescriptions')]
    private Collection $plate;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $choice = null;

    public function __construct()
    {
        
        $this->menus = new ArrayCollection();
        $this->plate = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDesc(): ?Order
    {
        return $this->order_desc;
    }

    public function setOrderDesc(?Order $order_desc): static
    {
        $this->order_desc = $order_desc;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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
            $menu->addMenuOrder($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): static
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeMenuOrder($this);
        }

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

    public function getChoice(): ?array
    {
        return $this->choice;
    }

    public function setChoice(?array $choice): static
    {
        $this->choice = $choice;

        return $this;
    }
}