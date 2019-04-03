<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;

use App\Http\Requests\RegisterHandleRequest;
use App\User;
use Auth;
class UsersController extends Controller
{
    //
    public function index()
    {
        return view('ManageUsers.all_users');

    }
    public function delete_user( $user_id)
    {
        $Admin = Auth::user()->level;
        // Only Admin  have permission to delete users
        if( $Admin === 'admin'){

            // no anyone have permission to delete account admin
            $user = User::find( $user_id);
            if( $user->level === 'admin'){
                return view('others.bad_request');
            }else{
                $user->delete();
                session()->flash('user_deleted_succeed', trans('translate.user_deleted_succeed'));
                return redirect(url('all_users'));
            }

        }else{
            return view('others.bad_request');
        }
    }
    public function edit_user($user_id)
    {
        $user = User::find($user_id);
        $action_type = 'update';
        return view('ManageUsers.create_edit_user', compact('user', 'action_type'));
    }
    public function Show_Profile()
    {
        $user = Auth::user();
        return view('ManageUsers.my_profile', compact('user'));
    }
    public function update_user( RegisterHandleRequest $request)
    {
        $data = $request->input();
        unset($data['_token']);
        unset($data[ 'password_confirmation']);
        //dd($data);
        $Admin = Auth::user()->level;
        // Only Admin  have permission to update users information
        if($Admin  === 'admin')
        {
            $data['password'] = bcrypt($data['password']);
            $user = User::where( 'id', $request->input('id'))->update($data);
            session()->flash('user_updated_succeed', trans('translate.user_updated_succeed'));
            return redirect(url('all_users'));

        }else{
            return view('others.bad_request');
        }
        dd(request());
        return view('ManageUsers.create_edit_user', compact('user', 'action_type'));
    }
    public function change_password( RegisterHandleRequest $request)
    {
        $data = $request->input();
        $user = Auth::user();
        $user->password =  bcrypt($data['password']);
        $user->save();
        session()->flash('password_updated_succeed', trans( 'translate.password_updated_succeed'));
        return redirect(url( 'myProfile'));
    }

    public function getUsers()
    {

        $users = User::select(['id', 'firstname', 'lastname', 'email','level', 'created_at']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                $delete_btn = ($user->level === 'user') ? '<button onclick="delete_user('.$user->id.')" id="'. $user->id.'" class= " btn btn-xs btn-danger btn-circle deleteUser"><i class="fas fa-trash-alt"></i></button>':'';
                return '<a href="'.route( "edit_user",[ "user_id" => $user->id]) .'" class= " btn btn-circle btn-success"><i class="far fa-edit"></i></a> '. $delete_btn;
                })
            ->make(true);
    }
    public function createUser(){
        $user = new User();
        $action_type = 'register';
        return view( 'ManageUsers.create_edit_user', compact('user', 'action_type'));
    }
}
