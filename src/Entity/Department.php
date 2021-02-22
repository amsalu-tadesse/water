<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=StockRequest::class, mappedBy="requestingDept")
     */
    private $stockRequests;

    public function __construct()
    {
        $this->stockRequests = new ArrayCollection();
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

  

     
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|StockRequest[]
     */
    public function getstockRequests(): Collection
    {
        return $this->stockRequests;
    }

    public function addstockRequest(StockRequest $StockRequest): self
    {
        if (!$this->stockRequests->contains($StockRequest)) {
            $this->stockRequests[] = $StockRequest;
            $StockRequest->setRequestingDept($this);
        }

        return $this;
    }

    public function removestockRequest(StockRequest $StockRequest): self
    {
        if ($this->stockRequests->removeElement($StockRequest)) {
            // set the owning side to null (unless already changed)
            if ($StockRequest->getRequestingDept() === $this) {
                $StockRequest->setRequestingDept(null);
            }
        }

        return $this;
    }
}
