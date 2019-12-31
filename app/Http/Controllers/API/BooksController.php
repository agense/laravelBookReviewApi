<?php

namespace App\Http\Controllers\API;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\BookRequest;

//Resources
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\FullBook as FullBookResource;

class BooksController extends Controller
{
    //Protect class with authentication middleware, except the open routes
    public function __construct(){
        return $this->middleware('auth:api')->except('index', 'show');
    }
    
    /**
     * Display a listing of all books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Filter books by query parameters
        $query = Book::filteredBooks();

        if(request()->has('paginate')){
            $books = $query->paginate(intval(request('paginate')));
            return BookResource::collection($books)->appends(request()->query());
         }else{
             $books = $query->get();
             return BookResource::collection($books);
         }  
    }

    /**
     * Store a newly created book in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request, ImageUploadService $imageService)
    {
        $data = $request->validated();

        //upload the image if exists
        if($request->image){
            $imageUrl = $imageService->uploadImage($request->image);
            if($imageUrl){
                $data['image'] = $imageUrl;
            }else{
                return response()->json(['errors' => ['image' => 'Image Upload Failed']], 422);
            }
        }
        $book = auth()->user()->books()->create($data);
        return new FullBookResource($book);
    }

    /**
     * Display the specified book.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new FullBookResource($book);
    }

    /**
     * Update the specified book in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book, ImageUploadService $imageService)
    {
        //Authorize only admins and users who uploaded the book to edit it
        $this->authorize('update', $book);

        $data = $request->validated();

        if($request->image){
            $imageUrl = $imageService->uploadImage($request->image);
            //set the image url to data
            if($imageUrl){
                $data['image'] = $imageUrl;
            }else{
                return response()->json(['errors' => ['image' => 'Image Upload Failed']], 422);
            }
            //delete the previous featured image
            if($book->image){
                $imageService->deleteImage($book->image);
            }
        }
        $book->update($data);
        $updatedBook = Book::where('id', $book->id)->first();
        return new FullBookResource($updatedBook);
    }

    /**
     * Remove the specified book from database.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, ImageUploadService $imageService)
    {
        //Authorize only admins and users who uploaded the book to edit it
        $this->authorize('delete', $book);

        //delete the featured image if exists
        if($book->image){
            $imageService->deleteImage($book->image);
        }
        $book->delete();
        return response()->json(['message' => 'Book Deleted']);   
    }
}
