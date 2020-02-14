<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Playstation;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PlaystationResource;

class PlaystationController extends Controller
{
    public function index()
    {
        $play = Playstation::latest()->get();
        return PlaystationResource::collection($play);
    }

    public function show(Request $request, $id)
    {
        // cara 2
        // return new QuoteResource($quote);
        // $cari = "PS 2";
        // $play = Playstation::find($id);
        // $play = Playstation::where('nama', $id)->get();

        $user = Playstation::where('nama', $id)->first();

        if ($user) {
            return response()->json([
                // 'code' => 1,
                // 'status' => "Success",
                // 'message' => "Data retrieved",
                // 'data' => [
                    'nama' => $user->nama,
                    'harga' => $user->harga,
                    "Response" => "True",
                // ]
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'status' => "error",
                'message' => "Data not found",
            ]);
        }

        // echo $user->name;

        // dd($play);

        // if ($play) {
        //     return new PlaystationResource($play);
        // } else {
        //     return response()->json([
        //         'code' => 0,
        //         'status' => "error",
        //         'message' => "Data not found",
        //     ]);
        // }

        // cara 2
    }

    public function update(Request $request, Playstation $playstation)
    {
        $this->authorize('update', $playstation);

        $playstation->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return new PlaystationResource($playstation);
    }

    public function destroy(Request $request, Playstation $playstation)
    {
        $this->authorize('delete', $playstation);

        $playstation->delete();

        return response()->json([
            'code' => 1,
            'status' => "success",
            'message' => "Data deleted",
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
        ]);

        $play = Playstation::create([
            // 'user_id' => auth()->id(),
            'nama' => $request->nama,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'code' => 1,
            'status' => "success",
            'message' => "Data retrieved",
            'data' => [
                'id' => $play->id,
                'nama' => $play->nama,
                'harga' => $play->harga,
                // relasi antar model quote dengan user
                // 'user' => new DataResource($quote->user),
            ],
        ]);

        // return new QuoteResource($quote);
    }
}
