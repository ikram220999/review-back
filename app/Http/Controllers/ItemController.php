<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Item_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $item = DB::table('items');

        if ($request->filter) {

            $s = json_decode($request->filter);
            if ($s->category > 0) {

                //     // dd($s->category);
                $item = $item->where('category_id', "=", $s->category);
            }

            if($s->name){
                $item = $item->where('name', 'LIKE', '%'.$s->name.'%');
            }
        };
        $item = $item->select("*");
        $item = $item->paginate();

        foreach ($item as $key => $val) {

            $url = Storage::url($val->image);

            $val->image = $url;
            // dd($key);
        }

        return response()->json($item, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $item = new Item();
        $itemReview = new Item_review();

        $item->name = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id = $request->category;

        if ($request->image) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $input['image'] = $imageName;
            request()->image->move(public_path('storage'), $imageName);

            $item->image = $imageName;
        }
        // dd($request->image);
        $item->rating = $request->rating;
        $item->save();

        $itemReview->item_id = $item->id;
        $itemReview->rating = $request->rating;

        $itemReview->save();

        return response()->json([$item, $itemReview], Response::HTTP_CREATED);
    }

    public function voteUp(Request $request)
    {
        if ($request->ucbool == "false") {
            $item = Item::find($request->id);
            $item->vote = $item->vote + 1;

            $item->save();
        } else {
            $item = Item::find($request->id);
            $item->vote = $item->vote - 1;

            $item->save();
        }
        // dd($request->id);
        return response()->json($item, Response::HTTP_OK);

    }

    public function voteDown(Request $request)
    {
        if ($request->dcbool == "false") {
            $item = Item::find($request->id);
            $item->vote = $item->vote - 1;

            $item->save();
        } else {
            $item = Item::find($request->id);
            $item->vote = $item->vote + 1;

            $item->save();
        }
        // dd($request->id);
        return response()->json($item, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
