<?php


namespace Example\Domains\Order;


use Example\Domains\Customer\CustomerInterface;
use Example\Domains\Product\ProductLineInterface;

class Order implements OrderInterface
{
    /**
     * @var ProductLineInterface[]
     */
    private array $products;

    /**
     * @var CustomerInterface
     */
    private CustomerInterface $customer;

    /**
     * Order constructor.
     * @param ProductLineInterface[] $products
     * @param CustomerInterface $customer
     */
    public function __construct(array $products, CustomerInterface $customer)
    {
        $this->products = $products;
        $this->customer = $customer;
    }

    public function getId(): int
    {
        // TODO: Implement getId() method.
    }

    public function setDiscount(float $rate)
    {
        // TODO: Implement setDiscount() method.
    }

    public function getTotalVat(): float
    {
        // TODO: Implement getTotalVat() method.
    }

    public function getTotalPrice($withVat = true): float
    {
        // TODO: Implement getTotalPrice() method.
    }
}