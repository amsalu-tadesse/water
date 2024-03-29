<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;


  

  

  

    /**
     * @ORM\OneToMany(targetEntity=ProductDelivery::class, mappedBy="product")
     */
    private $productDeliveries;

  

    /**
     * @ORM\OneToMany(targetEntity=StockList::class, mappedBy="product")
     */
    private $stockLists;

    /**
     * @ORM\OneToMany(targetEntity=StockRequestList::class, mappedBy="product")
     */
    private $stockRequestLists;

    /**
     * @ORM\OneToMany(targetEntity=ConsumptionRequestList::class, mappedBy="product")
     */
    private $consumptionRequestLists;

    /**
     * @ORM\OneToMany(targetEntity=ConsumptionDeliveryList::class, mappedBy="product")
     */
    private $consumptionDeliveryLists;

    /**
     * @ORM\OneToMany(targetEntity=ProductDeliveryList::class, mappedBy="product")
     */
    private $productDeliveryLists;

    /**
     * @ORM\OneToMany(targetEntity=SellsList::class, mappedBy="product")
     */
    private $sellsLists;

    /**
     * @ORM\OneToMany(targetEntity=StockBalance::class, mappedBy="product")
     */
    private $stockBalances;

    /**
     * @ORM\OneToMany(targetEntity=ConsumptionBalance::class, mappedBy="product")
     */
    private $consumptionBalances;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=ProductionReport::class, mappedBy="product", cascade={ "remove"})
     */
    private $productionReport;

    /**
     * @ORM\OneToMany(targetEntity=MaterialRecord::class, mappedBy="product")
     */
    private $materialRecords;

    public function __construct()
    {
   
     
        $this->stockLists = new ArrayCollection();
        $this->stockRequestLists = new ArrayCollection();
        $this->consumptionRequestLists = new ArrayCollection();
        $this->consumptionDeliveryLists = new ArrayCollection();
        $this->productDeliveryLists = new ArrayCollection();
        $this->sellsLists = new ArrayCollection();
        $this->stockBalances = new ArrayCollection();
        $this->consumptionBalances = new ArrayCollection();
        $this->materialRecords = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

   

    /**
     * @return Collection|StockList[]
     */
    public function getStockLists(): Collection
    {
        return $this->stockLists;
    }

    public function addStockList(StockList $stockList): self
    {
        if (!$this->stockLists->contains($stockList)) {
            $this->stockLists[] = $stockList;
            $stockList->setProduct($this);
        }

        return $this;
    }

    public function removeStockList(StockList $stockList): self
    {
        if ($this->stockLists->removeElement($stockList)) {
            // set the owning side to null (unless already changed)
            if ($stockList->getProduct() === $this) {
                $stockList->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StockRequestList[]
     */
    public function getStockRequestLists(): Collection
    {
        return $this->stockRequestLists;
    }

    public function addStockRequestList(StockRequestList $stockRequestList): self
    {
        if (!$this->stockRequestLists->contains($stockRequestList)) {
            $this->stockRequestLists[] = $stockRequestList;
            $stockRequestList->setProduct($this);
        }

        return $this;
    }

    public function removeStockRequestList(StockRequestList $stockRequestList): self
    {
        if ($this->stockRequestLists->removeElement($stockRequestList)) {
            // set the owning side to null (unless already changed)
            if ($stockRequestList->getProduct() === $this) {
                $stockRequestList->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConsumptionRequestList[]
     */
    public function getConsumptionRequestLists(): Collection
    {
        return $this->consumptionRequestLists;
    }

    public function addConsumptionRequestList(ConsumptionRequestList $consumptionRequestList): self
    {
        if (!$this->consumptionRequestLists->contains($consumptionRequestList)) {
            $this->consumptionRequestLists[] = $consumptionRequestList;
            $consumptionRequestList->setProduct($this);
        }

        return $this;
    }

    public function removeConsumptionRequestList(ConsumptionRequestList $consumptionRequestList): self
    {
        if ($this->consumptionRequestLists->removeElement($consumptionRequestList)) {
            // set the owning side to null (unless already changed)
            if ($consumptionRequestList->getProduct() === $this) {
                $consumptionRequestList->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConsumptionDeliveryList[]
     */
    public function getConsumptionDeliveryLists(): Collection
    {
        return $this->consumptionDeliveryLists;
    }

    public function addConsumptionDeliveryList(ConsumptionDeliveryList $consumptionDeliveryList): self
    {
        if (!$this->consumptionDeliveryLists->contains($consumptionDeliveryList)) {
            $this->consumptionDeliveryLists[] = $consumptionDeliveryList;
            $consumptionDeliveryList->setProduct($this);
        }

        return $this;
    }

    public function removeConsumptionDeliveryList(ConsumptionDeliveryList $consumptionDeliveryList): self
    {
        if ($this->consumptionDeliveryLists->removeElement($consumptionDeliveryList)) {
            // set the owning side to null (unless already changed)
            if ($consumptionDeliveryList->getProduct() === $this) {
                $consumptionDeliveryList->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductDeliveryList[]
     */
    public function getProductDeliveryLists(): Collection
    {
        return $this->productDeliveryLists;
    }

    public function addProductDeliveryList(ProductDeliveryList $productDeliveryList): self
    {
        if (!$this->productDeliveryLists->contains($productDeliveryList)) {
            $this->productDeliveryLists[] = $productDeliveryList;
            $productDeliveryList->setProduct($this);
        }

        return $this;
    }

    public function removeProductDeliveryList(ProductDeliveryList $productDeliveryList): self
    {
        if ($this->productDeliveryLists->removeElement($productDeliveryList)) {
            // set the owning side to null (unless already changed)
            if ($productDeliveryList->getProduct() === $this) {
                $productDeliveryList->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SellsList[]
     */
    public function getSellsLists(): Collection
    {
        return $this->sellsLists;
    }

    public function addSellsList(SellsList $sellsList): self
    {
        if (!$this->sellsLists->contains($sellsList)) {
            $this->sellsLists[] = $sellsList;
            $sellsList->setProduct($this);
        }

        return $this;
    }

    public function removeSellsList(SellsList $sellsList): self
    {
        if ($this->sellsLists->removeElement($sellsList)) {
            // set the owning side to null (unless already changed)
            if ($sellsList->getProduct() === $this) {
                $sellsList->setProduct(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|StockBalance[]
     */
    public function getStockBalances(): Collection
    {
        return $this->stockBalances;
    }

    public function addStockBalance(StockBalance $stockBalance): self
    {
        if (!$this->stockBalances->contains($stockBalance)) {
            $this->stockBalances[] = $stockBalance;
            $stockBalance->setProduct($this);
        }

        return $this;
    }

    public function removeStockBalance(StockBalance $stockBalance): self
    {
        if ($this->stockBalances->removeElement($stockBalance)) {
            // set the owning side to null (unless already changed)
            if ($stockBalance->getProduct() === $this) {
                $stockBalance->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConsumptionBalance[]
     */
    public function getConsumptionBalances(): Collection
    {
        return $this->consumptionBalances;
    }

    public function addConsumptionBalance(ConsumptionBalance $consumptionBalance): self
    {
        if (!$this->consumptionBalances->contains($consumptionBalance)) {
            $this->consumptionBalances[] = $consumptionBalance;
            $consumptionBalance->setProduct($this);
        }

        return $this;
    }

    public function removeConsumptionBalance(ConsumptionBalance $consumptionBalance): self
    {
        if ($this->consumptionBalances->removeElement($consumptionBalance)) {
            // set the owning side to null (unless already changed)
            if ($consumptionBalance->getProduct() === $this) {
                $consumptionBalance->setProduct(null);
            }
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProductionReport(): ?ProductionReport
    {
        return $this->productionReport;
    }

    public function setProductionReport(ProductionReport $productionReport): self
    {
        // set the owning side of the relation if necessary
        if ($productionReport->getProduct() !== $this) {
            $productionReport->setProduct($this);
        }

        $this->productionReport = $productionReport;
    }
    
    /**
     * @return Collection|MaterialRecord[]
     */
    public function getMaterialRecords(): Collection
    {
        return $this->materialRecords;
    }

    public function addMaterialRecord(MaterialRecord $materialRecord): self
    {
        if (!$this->materialRecords->contains($materialRecord)) {
            $this->materialRecords[] = $materialRecord;
            $materialRecord->setProduct($this);
        }

        return $this;
    }

    public function removeMaterialRecord(MaterialRecord $materialRecord): self
    {
        if ($this->materialRecords->removeElement($materialRecord)) {
            // set the owning side to null (unless already changed)
            if ($materialRecord->getProduct() === $this) {
                $materialRecord->setProduct(null);
            }
        }

        return $this;
    }
}
