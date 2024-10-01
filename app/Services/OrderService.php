<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\ProductOrder;
use DomainException;

class OrderService
{
    private ProductService $productService;
    private array $productOrders;
    public function __construct()
    {
        $this->productService = new ProductService();

    }

    public function create(int $total = 0, OrderStatusEnum $status = OrderStatusEnum::ABERTO): Order
    {
        $order = new Order();
        $order->status = $status;
        $order->total = $total;
        $order->save();

        return $order->refresh();
    }

    public function updateTotal(Order $order): int
    {
        $order->total = $order->getTotal();
        $order->save();

        return $order->total;
    }

    public function updateStatus(Order $order, string $status)
    {
        $status = OrderStatusEnum::tryFrom($status);

        if (is_null($status)) {
            throw new DomainException('Status inválido');
        }

        $order->status = $status->value;
        $order->save();
    }

    public function addProductOrder(Order $order, int $productId, int $quantity, float $price): void
    {
        $productOrder = new productOrder();
        $productOrder->quantity = $quantity;
        $productOrder->price = $this->productService->convertPriceToCents($price);
        $productOrder->product()->associate($productId);
        $productOrder->order()->associate($order);
        $productOrder->save();
    }
}
