<?php

namespace App\Http\Controllers\API;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\AuthorRequest;

//Resources
use App\Http\Resources\Author as AuthorResource;
use App\Http\Resources\Book as BookResource;


class AuthorsController extends Controller
{
    //Protect class with middleware
    public function __construct(){
        return $this->middleware('auth:api')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('name', 'ASC');
        if(request()->has('paginate')){
            $authors = $authors->paginate(intval(request('paginate')));
            return AuthorResource::collection($authors)->appends(request()->query());
         }else{
            $authors = $authors->get();
            return AuthorResource::collection($authors);
         } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request)
    {
        $data = $request->validated();

        $author = auth()->user()->authors()->create($data);
        return new AuthorResource($author);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorRequest $request, Author $author)
    {
        //Authorizes only admin users to update authors, using gate
        $this->authorize('isAdmin');

        $data = $request->validated();

        $author->update($data);
        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author, ImageUploadService $imageService)
    {
        //Authorizes only admin users to delete authors, using gate
        $this->authorize('isAdmin');
        
        // Because all books belonging to author will be deleted in db, delete book images from storage 
        if(count($author->books) > 0){
           foreach($author->books as $book){
            if($book->image){
                $imageService->deleteImage($book->image);
            }
           }
        }
        $author->delete();
        return response()->json(['message' => 'Author Deleted']);
    }
}
