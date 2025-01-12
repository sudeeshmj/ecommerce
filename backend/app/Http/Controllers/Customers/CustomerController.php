<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
   
    public function index(Request $request)
    {
       
        try {
            if ($request->ajax()) {
                $data =  Customer::query()->orderBy('id','Desc');
                
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($customer) {
                    return '<a href="" class="btn btn-sm bg-danger text-danger delete-icon-btn"
                                         data-toggle="modal" data-target="#DeleteModal"
                                         data-id="' . $customer->id . '"
                                           id="customer-delete-btn" >
                                         <i class="far fa-trash-alt" ></i>
                                    </a>';
                    })
                    ->editColumn('customer',function($customer) {
                        $url= $customer->image ? asset("images/uploads/customers/$customer->image"):asset('images/profile.png'); 
                       
                        return '<div class="customer d-flex">
                                <div class="avatar mr-3">
                                <img src="' . $url . '" border="0" width="40" class="img-fluid rounded-circle" align="center" />
                                </div>
                                 <div class="customer-data" style="font-weight: 600;color: #81acd5 !important;">
                                     '.e($customer->customer_name).'<br><small class="text-muted">' . e($customer->email) . '</small>
                                </div>
                        </div>';

                        
                       
                    })
                    ->rawColumns(['customer','action'])
                    ->make(true);
            }

            return view('customers.index');
        } catch (\Exception $e) {

            Log::error('Error fetching Customers: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
