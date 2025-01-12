<?php

namespace App\Http\Controllers\books;

use App\Events\OutOfStockEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Language;
use App\Models\BookFormat;
use App\Models\Tag;
use App\Models\BookSubCategory;
use App\Models\BookTag;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreBookRequest;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\BookFormatRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\TagRepository;
use App\Repositories\BookTagRepository;
use App\Repositories\BookSubCategoryRepository;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    protected $bookRepository;
    protected $bookSubCategoryRepository;
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $bookFormatRepository;
    protected $authorRepository;
    protected $languageRepository;
    protected $publisherRepository;
    protected $tagRepository;
    protected $bookTagRepository;

    public function __construct(

        BookRepository $bookRepository,
        BookSubCategoryRepository $bookSubCategoryRepository,
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository,
        BookFormatRepository $bookFormatRepository,
        AuthorRepository $authorRepository,
        LanguageRepository $languageRepository,
        PublisherRepository $publisherRepository,
        TagRepository $tagRepository,
        BookTagRepository $bookTagRepository,


    ) {

        $this->bookRepository = $bookRepository;
        $this->bookSubCategoryRepository = $bookSubCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->bookFormatRepository = $bookFormatRepository;
        $this->authorRepository = $authorRepository;
        $this->languageRepository = $languageRepository;
        $this->publisherRepository = $publisherRepository;
        $this->tagRepository = $tagRepository;
        $this->bookTagRepository = $bookTagRepository;
    }

    public function index(Request $request)
    {
        //ini_set('memory_limit', '256M');
        try {
            if ($request->ajax()) {
                $data =  Book::with([
                    'category:id,category_name',
                    'author:id,name',
                    'language:id,language_name',
                    'format:id,name',
                ]);

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($book) {
                        $editUrl = route('books.edit', $book->id);

                        return '<a href="' . $editUrl . '" class="btn btn-sm bg-success text-success edit-icon-btn"
                                      
                                        id="book-edit-btn" >
                                    <i class="fas fa-pencil-alt"></i></a>
                                    <a href="" class="btn btn-sm bg-danger text-danger delete-icon-btn"
                                         data-toggle="modal" data-target="#categoryDeleteModal"
                                         data-id="' . $book->id . '"
                                           id="book-delete-btn" >
                                         <i class="far fa-trash-alt" ></i>
                                    </a>';
                    })
                    ->editColumn('title', function ($book) {


                        return '<div style="font-weight: 600;color: #81acd5 !important;">' . e($book->title) . '<br>
                            <small class="text-muted"> [ ' . e($book->format->name) . ' ] </small>
                            <small class="text-muted"> [ ' . e($book->category->category_name) . ' ] </small>
                            </div>';
                    })


                    ->rawColumns(['title', 'action'])
                    ->make(true);
            }

            return view('bookstore.books.index');
        } catch (\Exception $e) {

            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong while fetching categories'], 500);
        }
    }


    public function create(): View
    {
        $categories =  $this->categoryRepository->getActiveCategories();
        $subCategories =  $this->subCategoryRepository->getActiveSubCategories();
        $formats =  $this->bookFormatRepository->getAllformats();
        $authors =  $this->authorRepository->getAllAuthors();
        $languages =  $this->languageRepository->getActiveLanguages();
        $publishers =  $this->publisherRepository->getActivePublishers();
        $tags =  $this->tagRepository->getAllTags();

        return view('bookstore.books.create', compact('categories', 'subCategories', 'languages', 'authors', 'publishers', 'formats', 'tags'));
    }

    public function store(StoreBookRequest $request)
    {
        try {
            $validated = $request->validated();
            $uploadedFilePath = null;
            if ($request->hasFile('book_image')) {

                $filePaths = config('app.file_paths');
                $file = $request->file('book_image');
                $uploadFolderName = $filePaths["BOOK"];

                $uploadedFilePath = uploadFile($file, $uploadFolderName);
            }
            $outOfStockNotify = $request->has('outofstock_check') ? 1 : 0;
            if ($uploadedFilePath) {

                $newBookData = [

                    'title' => $validated['title'],
                    'category_id' => $validated['category_id'],
                    'author_id' => $validated['author_id'],
                    'language_id' => $validated['language_id'],
                    'publisher_id' => $validated['publisher_id'],
                    'publishing_date' => $validated['publishing_date'],
                    'edition' => $validated['edition'],
                    'isbn' => $validated['isbn'],
                    'format_id' => $validated['format'],
                    'pages' => $validated['pages'],
                    'summary' => $validated['summary'],
                    'image' => $uploadedFilePath,
                    'price' => $validated['price'],
                    'offer_price' => $validated['offer_price'],
                    'stock' => $validated['stock'],
                    'threshold_stock' => $validated['threshold_stock'],
                    'outofstock_notify' => $outOfStockNotify,
                ];

                $book = $this->bookRepository->create($newBookData);

                if ($book) {

                    $this->bookSubCategoryRepository->saveBookSubCategories($validated['subcategory'], $book->id);
                    $this->bookTagRepository->saveBookTags($request->tag, $book->id);


                    // OutOfStockEvent::dispatch($book);  //dispatch event

                    return redirect()->route('books.index')->with('success', 'New Book added Successfully');
                }
            } else {

                return redirect()->route('books.index')->with('error', 'Failed to add new book');
            }
        } catch (Exception $e) {
            Log::info("book store error", $e->getMessage());
        }
    }

    public function show(int $id)
    {
        //
    }


    public function edit(int $id)
    {
        try {

            $book = Book::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('books.index')->with('error', 'Book not found');
        }

        $categories =  $this->categoryRepository->getActiveCategories();
        $subCategories =  $this->subCategoryRepository->getActiveSubCategories();
        $formats =  $this->bookFormatRepository->getAllformats();
        $authors =  $this->authorRepository->getAllAuthors();
        $languages =  $this->languageRepository->getActiveLanguages();
        $publishers =  $this->publisherRepository->getActivePublishers();
        $tags =  $this->tagRepository->getAllTags();

        return view('bookstore.books.update', compact('categories', 'subCategories', 'languages', 'authors', 'publishers', 'formats', 'tags', 'book'));
    }


    public function update(StoreBookRequest $request, int $id): RedirectResponse
    {

        try {

            $validated = $request->validated();

            $outOfStockNotify = $request->has('outofstock_check') ? 1 : 0;

            $updateBookData = [

                'title' => $validated['title'],
                'category_id' => $validated['category_id'],
                'author_id' => $validated['author_id'],
                'language_id' => $validated['language_id'],
                'publisher_id' => $validated['publisher_id'],
                'publishing_date' => $validated['publishing_date'],
                'edition' => $validated['edition'],
                'isbn' => $validated['isbn'],
                'format_id' => $validated['format'],
                'pages' => $validated['pages'],
                'summary' => $validated['summary'],

                'price' => $validated['price'],
                'offer_price' => $validated['offer_price'],
                'stock' => $validated['stock'],
                'threshold_stock' => $validated['threshold_stock'],
                'outofstock_notify' => $outOfStockNotify,
            ];

            if ($request->hasFile('book_image')) {

                $filePaths = config('app.file_paths');
                $file = $request->file('book_image');
                $uploadFolderName = $filePaths["BOOK"];
                $uploadedFilePath = uploadFile($file, $uploadFolderName);
                $updateBookData['image'] = $uploadedFilePath;
            }

            $book = $this->bookRepository->update($id, $updateBookData);

            if ($book) {
                $this->bookSubCategoryRepository->deleteBookSubCategories($book->id);
                $this->bookTagRepository->deleteBookTags($book->id);

                $this->bookSubCategoryRepository->saveBookSubCategories($validated['subcategory'], $book->id);
                $this->bookTagRepository->saveBookTags($request->tag, $book->id);

                return redirect()->route('books.index')->with('success', 'Book updated Successfully');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('books.index')->with('error', 'Book not found');
        }
    }


    public function destroy(int $id)
    {
        //
    }

    public function fetchSubCategories(Request $request): JsonResponse
    {

        $subCategories = $this->subCategoryRepository->getActiveSubCategoriesByCategory($request->category_id);

        if ($subCategories->isNotEmpty()) {

            return response()->json([
                'status' => 'success',
                'error' => false,
                'data' => $subCategories,
                'message' => 'Successfully got data from the server'
            ]);
        } else {

            return response()->json([
                'status' => 'failed',
                'error' => true,
                'error_code' => 404,
                'message' => "No data found"
            ]);
        }
    }
}
