<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuoteResource;
use Illuminate\Http\Request;
use App\Quote;
use API;
use App\Http\Resources\DataResource;

class QuoteController extends Controller
{
    public function index()
    {
        // $quotes = Quote::latest()->get();
        $quotes = Quote::latest()->paginate(5);
        return QuoteResource::collection($quotes);
    }

    public function show($id)
    {
        // cara 2
        // return new QuoteResource($quote);

        // cara 1
        $quotes = Quote::find($id);
        if ($quotes) {
            return new QuoteResource($quotes);
        } else {
            return response()->json([
                'code' => 0,
                'status' => "error",
                'message' => "Data not found",
            ]);
        }

        // cara 2
    }

    public function update(Request $request, Quote $quote)
    {
        $this->authorize('update', $quote);

        $quote->update([
            'message' => $request->message,
        ]);

        return new QuoteResource($quote);
    }

    public function destroy(Request $request, Quote $quote)
    {
        $this->authorize('delete', $quote);

        $quote->delete();

        return response()->json([
            'code' => 1,
            'status' => "success",
            'message' => "Data deleted",
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        $quote = Quote::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json([
            'code' => 1,
            'status' => "success",
            'message' => "Data retrieved",
            'data' => [
                'id' => $quote->id,
                'message' => $quote->message,
                // relasi antar model quote dengan user
                'user' => new DataResource($quote->user),
            ],
        ]);

        // return new QuoteResource($quote);
    }
}
