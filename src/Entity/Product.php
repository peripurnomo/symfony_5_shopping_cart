<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="`products`")
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(name="product_name", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min=2, max=180,
     *      minMessage="Your product name must be at least {{ limit }} characters long",
     *      maxMessage="Your product name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\Column(name="product_description", type="text", nullable=false)
     * @Assert\NotBlank(message="Product description cannot be blank.")
     * @Assert\Length(
     *      min=2, max=1024,
     *      minMessage="Your description must be at least {{ limit }} characters long",
     *      maxMessage="Your description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @ORM\Column(name="product_price", type="float", nullable=false)
     * @Assert\NotBlank(message="Product price cannot be blank.")
     */
    private $price;

    /**
     * @ORM\Column(name="product_code", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Product code cannot be blank.")
     */
    private $code = 'product';

    public function __construct()
    {
        $this->created = new \DateTime('NOW');
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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
}