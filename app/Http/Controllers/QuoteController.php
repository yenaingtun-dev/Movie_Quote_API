<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Resources\Quote as QuoteResource;

class QuoteController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quote = Quote::paginate('5'); 
        return QuoteResource::collection($quote);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quote'=>'required',
            'title'=>'required',
            'year'=>'required'
        ]);

        $quote = Quote::create($request->all());
        return response()->json([
            'Quote Created Successfully', $quote
        ],200);            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        QuoteResource::withoutWrapping();

        $quote = Quote::find($quote);
        return QuoteResource::collection($quote);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $quote->update($request->all()); 
         return response()->json([
            'Quote Created Successfully', QuoteResource::collection($quote)
        ],200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        $quote->delete(); 
        
        return response()->json(['Quote Deleted!'],200);
    }
}
