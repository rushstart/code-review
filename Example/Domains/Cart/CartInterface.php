<?php


namespace Example\Domains\Cart;

use Example\Domains\Customer\CustomerInterface;
use Example\Domains\Product\ProductInterface;
use Example\Domains\Product\ProductLineInterface;

/**
 * Interface CartInterface
 * @package Example
 */
interface CartInterface
{
    /**
     * @return float
     */
    public function getTotalVat(): float;

    /**
     * @param bool $withVat
     * @return float
     */
    public function getTotalPrice($withVat = true): float;

    /**
     * Owner this cart
     * @return CustomerInterface
     */
    public function getCustomer(): CustomerInterface;


    /**
     * @return ProductLineInterface[]
     */
    public function getProducts(): array;

    /**
     * Adds product in the cart
     * @param ProductInterface $product
     * @param float $qty
     */
    public function add(ProductInterface $product, float $qty): void;

    /**
     * Removes product from the cart
     * @param ProductInterface $product
     * @param float $qty
     */
    public function remove(ProductInterface $product, float $qty): void;

    /**
     * Removes all products from the cart
     */
    public function clear(): void;
}