<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request) {

        $review = new Review();

        $review->pid = $request->pid;
        $review->uid = $request->uid;
        $review->rating = $request->rating;
        $review->comment = $request->comment;

        $review->save();

    }


    public function show(Review $review)
    {
        //
    }


    public function edit(Review $review) {

    }


    public function update(Request $request, Review $review) {

    }


    public function destroy(Review $review)
    {
        //
    }
}