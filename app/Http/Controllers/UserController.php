<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GeneralSetting;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link'=>"/users",'name'=>"User"], ['name'=>"Users List"]
            ];


        $data = User::orderBy('id','DESC')->paginate(5);

  // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page' , 'pageHeader' => true];
        //return view('users.index1', ['pageConfigs' => $pageConfigs]);


        return view('users.index1',['data'=> $data, 'users'=> $data, 'pageConfigs'=>$pageConfigs], ['breadcrumbs'=>$breadcrumbs]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $breadcrumbs = [
            ['link'=>"/users",'name'=>"User"], ['name'=>"Users Create"]
            ];

        $pageConfigs = ['bodyCustomClass' => 'app-page' , 'pageHeader' => true];
        $roles = Role::pluck('name','name')->all();
        return view('users.create',['roles'=> $roles , 'pageConfigs'=>$pageConfigs], ['breadcrumbs'=>$breadcrumbs] );
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            //'user_type' => 'required|gt:2',
            'type' => 'required',
        ],[
                'type.required' => 'User Type filed is required',
                'password.required' => 'Password is required'
            ]
        );
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        $current_user_role = $user->getRoleNames()->toArray();
        $current_user_role = $current_user_role[0];
        $user_role = array($current_user_role=>$current_user_role);
    
        return view('users.edit',compact('user','roles','userRole','current_user_role'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return back()->with('success', 'User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }


    public function usersList()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('users.page-users-list', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function usersView()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users View"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('users.page-users-view', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function usersEdit()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users Edit"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('users.page-users-edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }


    public function changeDisplayName(Request $request)
    {
        $merchant_id = $request->merchant_id;
        $display_name = $request->display_name;

        DB::table('merchant_users')->where('merchant_id',$merchant_id)->update(array('display_name'=>$display_name));
        return response()->json(array('success'=>1));
    }

    public function changeContactNumber(Request $request)
    {
        $merchant_id = $request->merchant_id;
        $contact_number = $request->contact_number;

        DB::table('merchants')->where('id',$merchant_id)->update(array('contact_phone'=>$contact_number));
        return response()->json(array('success'=>1));
    }

    public function changeThemeColor(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $theme_color = $request->theme_color;

        GeneralSetting::where('merchant_id',$merchant_id)->update(array('theme_color'=>$theme_color));
        return response()->json(array('success'=>1));
    }

    public function changeThemeLogo(Request $request)
    {
        $input = $request->all();
        $merchant_id =  session()->get('merchant');
        if ($files = $request->file('theme_logo')) {
            // Define upload path
            $destinationPath = public_path('/uploads/logo/'); // upload path
            // Upload Orginal Image
            $uploadedImage = 'logo_'.date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $uploadedImage);
        }
        $url = asset('/uploads/logo/'.$uploadedImage);
         GeneralSetting::where('merchant_id',$merchant_id)->update(array('logo'=>$url));
        return response()->json(array('success'=>1));
    }

    public function changeThemeLanguage(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $theme_language = $request->theme_language;

        GeneralSetting::where('merchant_id',$merchant_id)->update(array('language'=>$theme_language));
        return response()->json(array('success'=>1));
    }

}

