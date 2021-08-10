<?php

namespace App\Http\Controllers;

use App\Notifications\AddUserEmail;
use App\Promocode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('active_status', '=', 1)->get();
        $roles = Role::all();
        return view('backEnd.promocode.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promocdes = Promocode::all();
        return view('backEnd.promocode.create', compact('promocdes'));
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
            'code'=>'required',
            'amount'=> 'required',
        ]);

        $promocode = new Promocode();
        $promocode->promocode = $request->get('code');
        $promocode->amount = $request->get('amount');
        $result = $promocode->save();

        if($result) {
            return redirect('/promocode/create')->with('message-success', 'promocode has been added');
        } else {
            return redirect('/promocode/create')->with('message-danger', 'Something went wrong, please try again');
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
        $editData = Promocode::find($id);
        $promocdes = Promocode::all();
   
        return view('backEnd.promocode.create', compact('editData','promocdes'));
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
      
          $request->validate([
              'code'=>'required',
          ]);

          $promocode = Promocode::find($id);
          $promocode->promocode = $request->get('code');
          $promocode->amount = $request->get('amount');
          $result = $promocode->save();
  
        
          if($result) {
                return redirect('/promocode/create')->with('message-success', 'promocode has been updated');
            } else {
                return redirect('/promocode/create')->with('message-danger', 'Something went wrong, please try again');
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

    
    public function deletePromocode($id){
        $promocode = Promocode::find($id);
        $result = $promocode->delete();

        if($result){
            return redirect()->back()->with('message-success-delete', 'Promocode has been deleted successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }
}
