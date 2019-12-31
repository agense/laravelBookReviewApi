<?php

namespace App\Http\Controllers\API;

use App\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\GenreRequest;


//Resources
use App\Http\Resources\Genre as GenreResource;
use App\Http\Resources\Book as BookResource;

class GenresController extends Controller
{
    //Protect class with middleware
        public function __construct(){
            return $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the all genres.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::orderBy('name', 'ASC');
        if(request()->has('paginate')){
            $genres = $genres->paginate(intval(request('paginate')));
            return GenreResource::collection($genres)->appends(request()->query());
         }else{
           $genres = $genres->get();
           return GenreResource::collection($genres);
         } 
    }

    /**
     * Store a newly created resource genre in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
        //Authorizes only admin users to create genres, using gate
        $this->authorize('isAdmin');
        
        $data = $request->validated();

        $genre = Genre::create($data);
        return new GenreResource($genre);
    }

    /**
     * Display the specified genre.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    /**
     * Update the specified genre in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        //Authorizes only admin users to update genres, using gate
        $this->authorize('isAdmin');

        $data = $request->validated();
        $genre->update($data);
        return new GenreResource($genre);
    }

    /**
     * Remove the specified resource genre from database.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre, ImageUploadService $imageService)
    {
        //Authorizes only admin users to delete genres, using gate
        $this->authorize('isAdmin');

        // Because all books belonging to the genre will be deleted in db, delete book images from storage 
        if(count($genre->books) > 0){
            foreach($genre->books as $book){
             if($book->image){
                 $imageService->deleteImage($book->image);
             }
            }
         }
        $genre->delete();
        return response()->json(['message' => 'Genre Deleted']);

    }
}
