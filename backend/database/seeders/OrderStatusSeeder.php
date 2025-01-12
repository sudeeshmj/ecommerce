<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['status'=>'Confirmed','created_at' => now(),'updated_at' => now()],
            ['status'=>'Shipped','created_at' => now(),'updated_at' => now()],
            ['status'=>'Out For Delivery','created_at' => now(),'updated_at' => now()],
            ['status'=>'Delivered','created_at' => now(),'updated_at' => now()],
            ['status'=>'Cancelled','created_at' => now(),'updated_at' => now()],
            ['status'=>'Return','created_at' => now(),'updated_at' => now()],
            ['status'=>'Ready to Pickup','created_at' => now(),'updated_at' => now()],
            ['status'=>'Refund','created_at' => now(),'updated_at' => now()],
    
        ];

        OrderStatus::insert($status);
    }
}
