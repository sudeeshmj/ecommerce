<?php

namespace App\Http\Controllers\Books;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Exception;
use Yajra\DataTables\DataTables;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct( CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository; 
    }

    public function index(Request $request):View
    {
        return view('bookstore.categories.index');
       
    }

    public function store(Request $request): RedirectResponse
    {  
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required'
        ]);
       
        $this->categoryRepository->create($validated);

        return redirect()->route('categories.index')->with('success', 'Category added Successfully');
    }

    public function edit(int $id): JsonResponse
    {
        
        $category = $this->categoryRepository->getById($id);
        return response()->json($category);
    }

    public function update(Request $request, int $id): RedirectResponse
    {

        $request->validate([
            'category_edt_name' => 'required|string|max:255',
            'category_status' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_name' => $request->category_edt_name,
            'status' => $request->category_status,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated Successfully');
    }

    // public function destroy($id)
    // {
    //     try {

    //         $category = Category::findOrFail($id);
    //         $category->delete();

    //         return redirect()->route('categories.index')
    //             ->with('success', 'Category deleted successfully');

    //     } 
    //     catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

    //         return redirect()->route('categories.index')
    //             ->with('error', 'Category not found');
    //     } 
    //     catch (\Exception $e) {

    //         return redirect()->route('categories.index')
    //             ->with('error', 'Delete Operation failed');
    //     }
    // }

    public function destroy(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        if ($category->delete()) {
            return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete category']);
    }

    public function fetchCategories(Request $request): JsonResponse 
    {
        try {
            if ($request->ajax()) {
                
                $data = Category::query()->orderBy('id','Desc');
                
                return Datatables::of($data)
           
                    ->addIndexColumn()         
                    ->addColumn('action', function ($category) {
                        $editUrl = route('categories.edit', $category->id);
                        $deleteUrl = route('categories.destroy', $category->id);
                        $itemText = 'Category : '.$category->category_name;

                        return '<a href="#" class="btn btn-sm bg-success text-success edit-icon-btn"
                                        data-toggle="modal" data-target="#categoryUpdateModal"
                                        data-id="' . $category->id . '"
                                        data-url="' . $editUrl . '"
                                        id="category-edit-btn" >
                                    <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm bg-danger text-danger delete-icon-btn"
                                         data-toggle="modal" data-target="#DeleteModal"
                                         data-id="' . $category->id . '"
                                         data-url = "'.$deleteUrl .'"
                                         data-text = "'. $itemText .'"
                                         data-table = "categories-data-table"
                                           id="category-delete-btn" >
                                         <i class="far fa-trash-alt" ></i>
                                    </a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } else {
                
                return response()->json(['error' => 'Invalid request type'], 400);
            }  
        } catch (\Exception $e) {

            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching categories'], 500);
        }
    }
}
