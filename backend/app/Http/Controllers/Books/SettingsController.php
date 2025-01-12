<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreInfo;
use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
class SettingsController extends Controller
{
    
    public function index(): View
    {
        $storeInfo = StoreInfo::first();
        $settings = Setting::pluck('setting_value', 'setting_key')->toArray();
       
        return view('bookstore.settings.index',compact('storeInfo','settings'));
        
    }

   

    public function storeStoreSettings(Request $request): JosnResponse
    {     
        $validator = Validator::make($request->all(),[

            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email',
            'store_phone' => 'required|integer|min:0',
            'store_address' => 'required|string|max:255',
           
        ]);
        $uploadedFilePath=null;
        if ($request->hasFile('store_logo')) { 

            $filePaths = config('app.file_paths');
            $file = $request->file('store_logo');
            $uploadFolderName = $filePaths["BOOK"];
        
            $uploadedFilePath = uploadFile($file, $uploadFolderName);
        }


        if ($validator->fails()) {
            return response()->json(['status'=>400,'error'=>$validator->errors()]);
        }
        else{
           
            $storeInfoData = [
                'store_name' => $request->store_name,
                'store_email' => $request->store_email,
                'store_phone' => $request->store_phone,
                'store_address' => $request->store_address,
            ];
            if ($uploadedFilePath) {
                $storeInfoData['store_logo'] = $uploadedFilePath;
            }
            $storeInfo = StoreInfo::updateOrCreate(
                ['id' => $request->store_id],
                $storeInfoData
            );
            return response()->json(['status'=>200,'message'=>'Store info updated']);
        }
    }

    public function storeNotificationSettings(Request $request): JosnResponse 
    {

        $formData = $request->except('_token');
        
        foreach ($formData as $key =>$value){
            Setting::updateOrCreate(
                ['setting_key' =>$key],
                [ 'setting_value' => $value]
            );
        }
        return response()->json(['status'=>200,'message'=>'Notification settings updated']);
    }

}
