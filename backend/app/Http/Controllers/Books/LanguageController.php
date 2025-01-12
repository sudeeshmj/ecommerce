<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Language;
use Yajra\DataTables\DataTables;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
class LanguageController extends Controller
{
    
    public function index(Request $request): View|JsonResponse
    {
        try {

            if ($request->ajax()) {
                $data = Language::query()->orderBy('id','Desc');
              
             
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($language) {
                      //  $editUrl = route('sub-categories.edit', $subcategory->id);
                      $languages = htmlspecialchars(json_encode($language), ENT_QUOTES, 'UTF-8');
                        return '<a href="#" class="btn btn-sm bg-success text-success edit-icon-btn"
                                  id="language_edit_btn"  data-content=\''.$languages.'\'     
                                 >
                                    <i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-sm bg-danger text-danger delete-icon-btn"
                                      data-toggle="modal" data-target="#languageDeleteModal"
                                          data-id="' . $language->id . '"
                                           id="language-delete-btn">
                                <i class="far fa-trash-alt" ></i>
                                    </a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
           
            return view('bookstore.languages.index');

        } catch (\Exception $e) {

            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching categories'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {       
        $validator = Validator::make($request->all(),[

            'language_name' => 'required|string|max:255',
            'language_status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400,'error'=>$validator->errors()]);
        }
        else{
           
            $language = Language::updateOrCreate(
                ['id' => $request->language_id],

                ['status' => $request->language_status,
                 'language_name' => $request->language_name
                ]
            );
            $message = $language->wasRecentlyCreated 
                ? 'Language added successfully' 
                : 'Language updated successfully';

            return response()->json(['status'=>200,'message'=>$message]);
        }
    }


    public function destroy($id): RedirectResponse
    {   
        try {

            $language = Language::findOrFail($id);
            $language->delete();

            return redirect()->route('languages.index')
                ->with('success', 'Language deleted successfully');

        } 
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('languages.index')
                ->with('error', 'Language not found');
        } 
        catch (\Exception $e) {

            return redirect()->route('languages.index')
                ->with('error', 'Delete Operation failed');
        }
    }
}
