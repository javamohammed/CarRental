<?php

namespace App\Http\Controllers\ManageAuth;

use App\User;
use App\Models\Unlocked;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterHandleRequest;
use Auth;
class RegisterController extends Controller
{
    public function index( $register_token )
    {
        $register_token_in_db = Unlocked::where( 'register_token', $register_token)->count();
        if( $register_token_in_db === 1){
            return view( 'auth.register');
        }else{
            return view('others.bad_request');
             //return 'link of register is invalid !!';

        }

        $countUser = User::count();
        if( $countUser === 0){
            //return view('auth.register');
            return view( 'auth.unlockedApps');
        }else{
            session()->flash('appsLocked', trans('translate.appsLocked'));
            return redirect(url('login'));
        }

    }
    public function unlocked()
    {
        //dd( config('app.locale'));
        $countUser = User::count();
        if($countUser === 0){
             return view( 'auth.unlockedApps');
        }else{
              session()->flash('appsLocked', trans('translate.appsLocked'));
            return redirect(url('login'));
        }
    }
    public function register( RegisterHandleRequest $request){

        $data = $request->input();
        $countUser = User::where('level','admin')->count();
        if( $countUser === 0 ){
            User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'level' => 'admin',
                'password' => bcrypt($data['password']),
            ]);
            Unlocked::truncate();
            session()->flash('admin_succeed', trans( 'translate.admin_succeed'));
            return redirect(url( 'login'));
        }else{
            if( Auth::id()){
                User::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'level' => 'user',
                    'password' => bcrypt($data['password']),
            ]);
                session()->flash( 'user_add_succeed', trans( 'translate.user_add_succeed'));
                return redirect(url( 'all_users'));
            }{
                session()->flash('appsLocked', trans('translate.appsLocked'));
                return redirect(url('login'));
            }

        }

    }
}
