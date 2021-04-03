<?php


namespace Example\UseCases;


use Example\Domains\Cart\CartInterface;
use Example\Domains\Order\Order;
use Example\Domains\Order\OrderInterface;
use Example\Services\NotifyInterface;

class ConvertCartToOrder
{
    private NotifyInterface $notifier;

    private OrderInterface $order;

    public function __constructor(CartInterface $cart, NotifyInterface $notifier)
    {
        $this->order = new Order($cart->getProducts(), $cart->getCustomer());
        $this->notifier = $notifier;
    }

    /**
     * @param float $rate from 0 to 100 as percent
     * @return ConvertCartToOrder
     */
    public function setDiscount(float $rate = 0): self
    {
        $this->order->setDiscount($rate);

        return $this;
    }

    /**
     * @return ConvertCartToOrder
     */
    public function sendNotifications(): self
    {
        $this->notifier->newOrderCreated($this->order);

        return $this;
    }

    public function getOrder(): OrderInterface
    {
        return $this->order;
    }
}