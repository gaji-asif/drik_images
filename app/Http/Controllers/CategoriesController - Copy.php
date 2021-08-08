<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ImageChild;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Category::with('children')->get();
        $parent_cat = Category::where('parent_category_id', 0)->get();

        return view('backEnd.category.create', compact('data', 'parent_cat'));
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

        $data = new Category();
        $data->cat_name = $request->cat_name;
        $data->ordering = $request->ordering;
        if (isset($request->parent_category_id)) {
            $data->parent_category_id = $request->parent_category_id;
        } else {
            $data->parent_category_id = 0;
        }
        $results = $data->save();
        if ($results) {
            return redirect()->back()->with('message-success', 'Category has been added');
        } else {
            return redirect()->back()->with('message-danger', 'Something went wrong');
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
        $data = Category::with('children')->get();
        $parent_cat = Category::where('parent_category_id', 0)->get();
        $editData = Category::find($id);
        return view('backEnd.category.create', compact('data', 'parent_cat', 'editData'));
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
        $data = Category::find($id);
        $data->cat_name = $request->cat_name;
        $data->ordering = $request->ordering;
        if (isset($request->parent_category_id)) {
            $data->parent_category_id = $request->parent_category_id;
        } else {
            $data->parent_category_id = 0;
        }
        $results = $data->save();
        if ($results) {
            return redirect('category')->with('message-success', 'Category has been Updated');
        } else {
            return redirect('category')->with('message-danger', 'Something went wrong');
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
    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $results = $data->delete();
        if ($results) {
            return redirect('category')->with('message-success', 'Category has been Deleted');
        } else {
            return redirect('category')->with('message-danger', 'Something went wrong');
        }
    }
}
