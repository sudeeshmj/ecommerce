<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AuthorController extends Controller
{

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Author::query()->orderBy('id', 'Desc');
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($author) {
                        $editUrl = route('authors.edit', $author->id);

                        return '<a href="' . $editUrl . '" class="btn btn-sm bg-success text-success edit-icon-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#" class="btn btn-sm bg-danger text-danger delete-icon-btn"
                                         data-toggle="modal" data-target="#authorDeleteModal"
                                          data-id="' . $author->id . '"
                                           id="author-delete-btn" >
                                         <i class="far fa-trash-alt" ></i>
                                </a>';
                    })
                    ->addColumn('image', function ($author) {
                        $url = $author->image ? asset("images/uploads/authors/$author->image") : asset('images/profile.png');
                        return '<img src="' . $url . '" border="0" width="50" height="50" class="rounded-circle" align="center" />';
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);
            }

            return view('bookstore.authors.index');
        } catch (\Exception $e) {

            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching categories'], 500);
        }
    }

    public function create(): View
    {
        return view('bookstore.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required'
        ]);
        $uploadedFilePath = NULL;
        if ($request->hasFile('author_image')) {

            $filePaths = config('app.file_paths');
            $file = $request->file('author_image');
            $uploadFolderName = $filePaths["AUTHOR"];

            $uploadedFilePath = $this->uploadFile($file, $uploadFolderName);
        }

        $author = Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'image' => $uploadedFilePath
        ]);

        return redirect()->route('authors.index')->with('success', 'Author added Successfully');
    }

    public function edit(int $id)
    {
        $author = Author::findOrFail($id);
        return view('bookstore.authors.update', compact('author'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $author = Author::findOrFail($id);
        $uploadedFilePath = $author->image;

        if ($request->hasFile('author_image')) {

            $filePaths = config('app.file_paths');
            $uploadFolderName = $filePaths["AUTHOR"];
            $existingFile =  $uploadFolderName . '/' . $uploadedFilePath;
            if ($uploadedFilePath && file_exists(public_path($existingFile))) {
                unlink(public_path($existingFile));
            }

            $file = $request->file('author_image');
            $uploadedFilePath = $this->uploadFile($file, $uploadFolderName);
        }

        $author->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'image' => $uploadedFilePath,
        ]);

        return redirect()->route('authors.index')
            ->with('success', 'Author updated Successfully');
    }

    public function destroy(int $id)
    {
        try {

            $author = Author::findOrFail($id);
            $image = $author->image;

            if ($image) {

                $filePaths = config('app.file_paths');
                $uploadFolderName = $filePaths["AUTHOR"];
                $existingFile =  $uploadFolderName . '/' . $image;
                if (file_exists(public_path($existingFile))) {
                    unlink(public_path($existingFile));
                }
            }

            $author->delete();
            return redirect()->route('authors.index')
                ->with('success', 'Author deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('authors.index')
                ->with('error', 'Author not found');
        } catch (\Exception $e) {

            return redirect()->route('authors.index')
                ->with('error', 'Delete Operation failed');
        }
    }

    public function uploadFile($file, string $folder)
    {
        try {

            $extension = $file->extension();
            $fileName = time() . '_' . '.' . $extension;
            $file->move(public_path($folder), $fileName);

            return $fileName;
        } catch (\Exception $e) {

            return false;
        }
    }
}
