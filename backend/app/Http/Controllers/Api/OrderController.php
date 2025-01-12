<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\DeliveryAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function fetchDeliveryAddresses(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' =>  'required|integer|min:1',
        ]);

        $deliveryAddress = DeliveryAddress::join('states', 'delivery_addresses.state_id', '=', 'states.id')
            ->where('delivery_addresses.customer_id', $request->customer_id)
            ->select(
                'delivery_addresses.*',
                'states.id as state_id',
                'states.name as state_name'
            )
            ->get();

        if ($deliveryAddress->isEmpty()) {
            return ApiResponseHelper::success('No delivery address found.', 200, []);
        }
        return ApiResponseHelper::success('Delivery addresses retrieved successfully', 200, $deliveryAddress);
    }

    public function updateDeliveryAddress(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'pincode' => 'required|numeric|digits:6',
            'locality' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:2|max:255',
            'state_id' => 'required|integer|exists:states,id',
            'landmark' => 'nullable|string|max:255',
            'address_type' => 'required|integer',
        ]);


        try {
            $deliveryAddress = DeliveryAddress::findOrFail($id);
            $deliveryAddress->update($validatedData);
            return ApiResponseHelper::success('Successfully updated the address', 200, $deliveryAddress);
        } catch (\Exception $e) {

            return ApiResponseHelper::error('Failed to update address', 500, $e->getMessage(),);
        }
    }

    public function createDeliveryAddress(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'pincode' => 'required|numeric|digits:6',
            'locality' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:2|max:255',
            'state_id' => 'required|integer|exists:states,id',
            'landmark' => 'nullable|string|max:255',
            'address_type' => 'required|integer',
        ]);

        $deliveryAddress = DeliveryAddress::create($validatedData);

        ApiResponseHelper::success('Delivery address created successfully', 201, $deliveryAddress);
    }
    public function placeOrder(Request $request)
    {
        $request->validate([

            'cutomer_id' => 'required|integer|exists:cutomers,id',
            'total_amount' => 'required|numeric|min:0',
            'order_amount' => 'required|numeric|min:0',
            'shipping_charge' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'payment_type' => 'required|integer',
            'payment_status' => 'required|integer',

            'products' => 'required|array|min:1',
            'products.*.book_id' => 'required|integer|exists:books,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',

            'shipping_address' => 'required|array|min:1',
            'shipping_address.name' => 'required|string|min:3|max:255',
            'shipping_address.phone_number' => 'required|numeric|digits:10',
            'shipping_address.pincode' => 'required|numeric|digits:6',
            'shipping_address.locality' => 'required|string|min:3|max:255',
            'shipping_address.address' => 'required|string|min:3|max:255',
            'shipping_address.city' => 'required|string|min:2|max:255',
            'shipping_address.state_id' => 'required|integer|exists:states,id',
            'shipping_address.landmark' => 'nullable|string|max:255',
            'shipping_address.address_type' => 'required|integer',

        ]);

        DB::beginTransaction();
        try {

            $orderId = $this->saveNewOrder($request);

            if (!$orderId) {
                return ApiResponseHelper::error("Failed to place new order.");
            }

            $orderDetailsCreated = $this->saveOrderItems($request, $orderId);

            if (!$orderDetailsCreated) {

                return ApiResponseHelper::error("Failed to place new order.");
            }
            $shippingAddress = $this->saveShippingAddress($request, $orderId);

            if (!$shippingAddress) {

                return ApiResponseHelper::error("Failed to place new order.");
            }
            $orderStatus = 1;
            $orderHistory = $this->saveOrderHistory($orderId, $orderStatus);

            if (!$orderHistory) {

                return ApiResponseHelper::error("Failed to place new order.");
            }

            DB::commit();
            return ApiResponseHelper::success("Successfully placed new order.");
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::error("Failed to place new order.");
        }
    }

    private function saveNewOrder(Request $request)
    {
        $newOrderRow = [
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'order_amount' => $request->order_amount,
            'shipping_charge' => $request->shipping_charge,
            'discount' => $request->discount,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status,
            'transaction_id' => $request->transaction_id,
            'order_status ' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $newOrderId = DB::table('b2b_orders')->insertGetId($newOrderRow);
        return $newOrderId;
    }

    private function saveOrderItems($request, $orderId)
    {
        $newOrderTxnRow = [];
        foreach ($request->products as $product) {

            $newOrderTxnRow[] = [
                'order_master_id' => $orderId,
                'book_id' => $product['book_id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'order_item_status' =>  1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        DB::table('order_items')->insert($newOrderTxnRow);
        return true;
    }

    private function saveShippingAddress($request, $orderId)
    {
        $newAddressRow = [
            'order_id ' => $orderId,
            'name' => $request->shipping_address['name'],
            'phone_number' => $request->shipping_address['phone_number'],
            'pincode' => $request->shipping_address['pincode'],
            'locality' => $request->shipping_address['locality'],
            'address' => $request->shipping_address['address'],
            'city' => $request->shipping_address['city'],
            'state_id ' => $request->shipping_address['state_id'],
            'landmark ' => $request->shipping_address['landmark'],
            'address_type ' => $request->shipping_address['address_type'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('order_shipping_addresses')->insert($newAddressRow);
        return true;
    }
    private function saveOrderHistory($orderId, $orderStatus)
    {
        $newStatusRow = [
            'order_id ' => $orderId,
            'order_status ' => $orderStatus,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('order_status_histories')->insert($newStatusRow);
        return true;
    }
}
