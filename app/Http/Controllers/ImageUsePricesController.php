<?php

namespace App\Http\Controllers;

use App\imageUsageCategorie;
use App\imageUsageSubCategorie;
use Illuminate\Http\Request;

class ImageUsePricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image_usage_categories = imageUsageCategorie::all();
        $data = imageUsageSubCategorie::with('categories')->get();
        return view('backEnd.image_use.create', compact('image_usage_categories','data'));
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
        $sub_cat = imageUsageSubCategorie::where('id', $request->input('sub_cat_id'))
        ->where('category_id', $request->input('cat_id'))
        ->first();
        $sub_cat->price = number_format((float)$request->input('price'), 2, '.', '');
        $result = $sub_cat->save();

        if ($result) {
            return redirect('image_use')->with('message-success', 'Price has been updated');
        } else {
            return redirect('image_use')->with('message-danger', 'Something went wrong, please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = imageUsageSubCategorie::where('id',$id)->with('categories')->first();
        $sub_cat = imageUsageSubCategorie::where('category_id',$editData->category_id)->get();
        $image_usage_categories = imageUsageCategorie::all();
        $data = imageUsageSubCategorie::with('categories')->get();
        return view('backEnd.image_use.create', compact('image_usage_categories','data','editData','sub_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sub_cat = imageUsageSubCategorie::where('id', $request->input('sub_cat_id'))
        ->where('category_id', $request->input('cat_id'))
        ->first();
        $sub_cat->price = number_format((float)$request->input('price'), 2, '.', '');
        $result = $sub_cat->save();

        if ($result) {
            return redirect('image_use')->with('message-success', 'Price has been updated');
        } else {
            return redirect('image_use')->with('message-danger', 'Something went wrong, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
