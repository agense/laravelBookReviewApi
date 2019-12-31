<?php

namespace App\Http\Controllers\API;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Review as ReviewResource;
use App\Http\Requests\ReviewRequest;
use App\Book;

class ReviewsController extends Controller
{
    //Protect class with middleware
    public function __construct(){
        return $this->middleware('auth:api')->except('index','show','bookReviews');
    }
    
    /**
     * Display a listing of all reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Filter books by query parameters
        $query = Review::filteredReviews();

        if(request()->has('paginate')){
            $reviews = $query->paginate(intval(request('paginate')));
            return ReviewResource::collection($reviews)->appends(request()->query());
         }else{
            $reviews = $query->get();
            return ReviewResource::collection($reviews);
         }
    }

    /**
     * Store a newly created review in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $data = $request->validated();

        $review = auth()->user()->reviews()->create($data);
        return new ReviewResource($review);
    }

    /**
     * Display the specified review
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified review in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, Review $review)
    {
        //Authorize only review authors to update their own reviews
        $this->authorize('update', $review);

        $data = $request->validated();
        $review->update($data);
        return new ReviewResource($review);
    }

    /**
     * Remove the specified review from database.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //Authorize review authors to delete their own reviews and admins to delete any review
        $this->authorize('delete', $review);

        $review->delete();
        return response()->json(['message' => 'Review Deleted']);
    }
}
