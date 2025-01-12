<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data =  Order::with([
                    'customer:id,customer_name,email,image',
                    'orderStatus:id,status'
                ]);


                return Datatables::of($data)

                    ->editColumn('id', function ($order) {
                        $url = route('orders.show', $order->id);
                        return '<a href="' . $url . '"><span class="order-list-order-id">#' . $order->id . '</span></a>';
                    })
                    ->editColumn('customer', function ($order) {
                        $url = $order->customer->image ? asset("images/uploads/customers/{$order->customer->image}") : asset('images/profile.png');

                        return '<div class="customer d-flex">
                                <div class="avatar mr-3">
                                <img src="' . e($url) . '" border="0" width="40" class="img-fluid rounded-circle" align="center" />
                                </div>
                                 <div class="customer-data" style="font-weight: 600;color: #696cff !important;">
                                     ' . e($order->customer->customer_name) . '<br><small class="text-muted">' . e($order->customer->email) . '</small>
                                </div>
                        </div>';
                    })
                    ->rawColumns(['id', 'customer'])
                    ->make(true);
            }
            $orderStatus = OrderStatus::get();
            return view('orders.index', compact('orderStatus'));
        } catch (\Exception $e) {
            //  Log::info($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to return a form for creating a new order
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic to handle storing a new order
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $order = Order::with([
            'customer:id,customer_name,email,image,phone_number',
            'orderStatus:id,status',
            'orderItems.book:id,title',
            'orderShippingAddress'
        ])->findOrFail($id);
        Log::info($order);
        $orderStatuses = OrderStatus::get();
        return view('orders.order-details', compact('orderStatuses', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Logic to return a form for editing an existing order
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Logic to update an existing order
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete an order
    }

    public function changeOrderStatus(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required|exists:orders,id',
            'status' => 'required|integer',
        ]);
        try {

            $order = Order::findOrFail($validatedData['id']);
            $orderStatus = (int) $validatedData['status'];

            DB::transaction(function () use ($order, $orderStatus) {

                $order->orderItems()->update(['order_item_status' => $orderStatus]);
                $order->update(['order_status' => $orderStatus]);
            });

            $order = Order::findOrFail($validatedData['id']);

            return response()->json([
                'status' => 'success',
                'error' => false,
                'data' => $order,
                'message' => 'Successfully updated the status.',
            ], 200);
        } catch (ModelNotFoundException $e) {

            return response()->json([
                'status' => 'failed',
                'error' => true,
                'error_code' => 404,
                'message' => 'Order not found.',
            ], 404);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'failed',
                'error' => true,
                'error_code' => 500,
                'message' => 'An error occurred while updating the order status. Please try again later.',
                'debug' => config('app.debug') ? $e->getMessage() : null, // Show error details in debug mode
            ], 500);
        }
    }
}
