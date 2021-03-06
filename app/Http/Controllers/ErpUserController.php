<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use Notification;
use App\Notifications\AddUserEmail;
use Session;

class ErpUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View User List|Edit User|Delete User|Assign Permission by User')->only('index');
        $this->middleware('permission:Edit User|Delete User')->only('edit','store','update');
        $this->middleware('permission:Assign Permission by User')->only('assignPermission','userPermissionStore');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$permission = Permission::create(['name' => 'Doc Type & Code']);
        //$permission = Permission::create(['name' => 'Speciality List']);
        $users = User::where('active_status', '=', 1)->get();
        $roles = Role::all();
        return view('backEnd.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$users = User::all();
        $users = User::where('active_status', '=', 1)->get();
        $roles = Role::all();
        return view('backEnd.users.create', compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get all uesr emails
        $all_user_email = User::get()->pluck('email');

        $request->validate([
            'name'=>'required',
            'email'=> 'required| unique:users,email,'.$request->get('email'),
            'password' => 'required',
            'upload_img'=> 'required|mimes:png,jpg,jpeg',
        ]);

        // dd($request->all());
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_type = 1;
        $user->country = $request->get('country');
        $user->phone =$request->get('phone');
        $user->assignRole($request->role_id);
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');
           $user->phone =$request->get('phone');
        if ($request->hasFile('upload_img')) {
            $upload = $request->file('upload_img');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('uploads/user_img');
            $upload->move($destinationPath, $upload_name);
            $user->upload_img = 'public/uploads/user_img/'.$upload_name;
        }

        $user->created_by = Auth::user()->id;

        if($password == $password_confirmation) {
            $user->password = Hash::make( $request->get('password') );
         
            $user->save();

            $user->notify(new AddUserEmail($user, $password));

            return redirect('/user')->with('message-success', 'User has been added');
        } else {
            return redirect('/user')->with('message-danger', 'Password does not match.');
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
        $editData = User::find($id);
        $roles = Role::all();
        return view('backEnd.users.edit', compact('editData', 'roles'));
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
        //get user hashed password
        $hashed_pass = User::find($id)->password;
        // get all uesr emails except this user id
        $all_user_email = User::where('id', '!=', $id)->pluck('email');

        $request->validate([
            'name'=>'required',
        ]);
       
        $userss = User::where('id', $id)->first();
        if(empty($request->get('password'))){
            $password = $userss->password;
        }
        else{
            $password = Hash::make( $request->get('password') );
        }

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $password;
        $user->syncRoles($request->role_id);
        $user->country = $request->get('country');
        $user->phone =$request->get('phone');
        //This foreach for checking if there are similar email address or not
        foreach ($all_user_email as $key => $value) {
            if( $value == $request->get('email') ) {
                return redirect('/user/'.$id.'/edit')->with('message-danger', 'Sorry this email already exists.');
            }
        }
        $user->update();
        return redirect('/user')->with('message-success', 'User has been updated');
    }

    public function editPassword($id)
    {
        $editData = User::find($id);
        $roles = Role::all();
        return view('backEnd.users.changePassword', compact('editData', 'roles'));
    }

    public function changePassword(Request $request, $id)
    {
        //get user hashed password
        $hashed_pass = User::find($id)->password;

        $user = User::find($id);
        $previous_password = $request->get('previous_password');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');
        $user->updated_at = Carbon::now();

        // validate passwords for users
        if( $previous_password != '' && $password != '' && $password_confirmation != '') {
            if( $password == $password_confirmation ) {
                if( Hash::check( $previous_password, $hashed_pass) ) {
                    $user->password = Hash::make( $request->get('password') );
                    $user->save();
                    return redirect('/user')->with('message-success', 'Your password has been changed.');
                } else {
                    return redirect('/user/editPassword/'.$id)->with('message-danger', 'Previous password does not match.');
                }
            }
            else {
                return redirect('/user/editPassword/'.$id)->with('message-danger', 'Password does not match.');
            }
        }
        else {
            return redirect('/user/editPassword/'.$id)->with('message-danger', 'Check your password.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
    public function deleteUserView($id){
        $module = 'deleteUser';
         return view('backEnd.showDeleteModal', compact('id','module'));
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->active_status = 0;
        $result = $user->update();

        if($result){
            return redirect()->back()->with('message-success-delete', 'User has been suspended successfully');
        }else{
            return redirect()->back()->with('message-danger-delete', 'Something went wrong, please try again');
        }
    }

    public function assignPermission($user_id){

        $user=User::find($user_id);
        $permissions=Permission::all();
        $user_permissions=$user->getAllPermissions();
        $already_assigned = [];
        foreach($user_permissions as $user_permission){
            $already_assigned[] = $user_permission->id;
        }

        return view('backEnd.users.assignPermission', compact('permissions','user','already_assigned'));
    }

    public function userPermissionStore(Request $request){

        $user=User::find($request->user_id);
        $user->syncPermissions($request->permissions);
        return redirect('user')->with('message-success-assign-user', 'User permission has been assigned successfully');
    }

    public function profile(){
        $id = Auth::user()->id;
        $user = user::find($id);

        return view('backEnd.users.profile',compact('user'));
    }
    public function edit_profile(Request $request){

        $id = Auth::user()->id;
        $userss = User::where('id', Auth::user()->id)->first();
        if(empty($request->get('password'))){
            $password = $userss->password;
        }
        else{
            $password = Hash::make( $request->get('password') );
        }

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $password;


        if ($request->hasFile('upload_img')) {
            $upload = $request->file('upload_img');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('uploads/user_img');
            $upload->move($destinationPath, $upload_name);
            $user->upload_img = 'public/uploads/user_img/'.$upload_name;
        }

        
        $result = $user->update();
        if($result){
        //$userss = User::where('id', Auth::user()->id)->first();
        Session::put('users_img', $userss->upload_img);
        }

        
        return redirect('profile')->with('message-success', 'Profile has been updated');
    }

}
