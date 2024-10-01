<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateStatusOrderRequest;
use App\Http\Resources\Order\ExtendedOrderResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    /**
     * Lista todos os pedidos
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Cria um novo pedido
     */
    public function store(StoreOrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $items = $request->validated('produtos');
            $order = $this->orderService->create();

            foreach ($items as $item) {
                $this->orderService->addProductOrder(
                    $order,
                    $item['produto_id'],
                    $item['quantidade'],
                    $item['preco']
                );
            }

            $this->orderService->updateTotal($order);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return response(new ExtendedOrderResource($order), 201);
    }

    /**
     * Exibe detalhes de um pedido
     */
    public function show(Order $order)
    {

        return response(new ExtendedOrderResource($order));
    }

    /**
     * Atualiza o status de um pedido
     */
    public function updateStatus(UpdateStatusOrderRequest $request, Order $order)
    {
        $this->orderService->updateStatus($order, $request->validated('status'));

        return response(new ExtendedOrderResource($order), 200);
    }
}
