<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
class SubCategoryController extends Controller
{
   
    public function index(Request $request): View|JsonResponse
    {

        try {

            if ($request->ajax()) {

                $data = SubCategory::with(['category:id,category_name'])
                        ;
             
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($subcategory) {
                        $editUrl = route('sub-categories.edit', $subcategory->id);
                        $deleteUrl = route('sub-categories.destroy', $subcategory->id);
                        $itemText = 'Sub category : '.$subcategory->subcategory_name;

                        return '<a href="#" class="btn btn-sm bg-success text-success edit-icon-btn"
                                        data-toggle="modal" data-target="#subCategoryUpdateModal"
                                       data-id="'.$subcategory->id.'"
                                       data-url="'.$editUrl.'"
                                        id="subcategory-edit-btn" >
                                    <i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-sm bg-danger text-danger delete-icon-btn"
                                         data-toggle="modal" data-target="#DeleteModal"
                                          data-id="' . $subcategory->id . '"
                                          data-url = "'.$deleteUrl .'"
                                          data-text = "'. $itemText .'"
                                           data-table = "sub-categories-data-table"
                                           id="sub-category-delete-btn" >
                                         <i class="far fa-trash-alt" ></i>
                                    </a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            $categories = Category::all();
            return view('bookstore.subcategories.index',compact('categories'));

        } catch (\Exception $e) {

            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching categories'], 500);
        }
       
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'category_id'=>'required|integer',
            'sub_category_name' => 'required|string|max:255',
            'sub_category_status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400,'error'=>$validator->errors()]);
        }
        else{

            SubCategory::create([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->sub_category_name,
                'status' => $request->sub_category_status,
            ]);

            return response()->json(['status'=>200,'message'=>'Sub category added Successfully']);
        }
    }

    public function edit(int $id): JsonResponse
    {
        $subCategory = SubCategory::findOrFail($id);
        return response()->json($subCategory);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'category_edt_id' => 'required|integer',
            'sub_category_edt_name' => 'required|string|max:255',
            'sub_category_edt_status' => 'required'
        ]);

        SubCategory::findOrFail($id)->update([
            'category_id' => $request->category_edt_id,
            'subcategory_name' => $request->sub_category_edt_name,
            'status' => $request->sub_category_edt_status,
        ]);

        return redirect()->route('sub-categories.index')
            ->with('success', 'Sub Category updated Successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $subCategory = SubCategory::findOrFail($id);
        if ($subCategory->delete()) {
            return response()->json(['success' => true, 'message' => 'Sub Category deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete Sub Category']);
    }
}
