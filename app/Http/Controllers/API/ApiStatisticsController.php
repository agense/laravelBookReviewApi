<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiStatisticsController extends Controller
{
    //Protect class with middleware
    public function __construct(){
        return $this->middleware('auth:api');
    }
    /**
     * Return basic api statictics
     */
    public function index(){
        $stats = array();
        $stats['userCount'] = DB::table('users')->where('role', '<>', 'admin')->count();
        $stats['adminCount'] = DB::table('users')->where('role','admin')->count();
        $stats['genreCount'] = DB::table('genres')->count();
        $stats['authorCount'] = DB::table('authors')->count();
        $stats['bookCount'] = DB::table('books')->count();
        $stats['reviewCount'] = DB::table('reviews')->count();

        return response()->json(['data' => $stats]);

    }
}
