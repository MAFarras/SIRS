<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Jabatan;
use App\User;
use Auth;

class UserController extends Controller
{
    //user
    public function showUser(){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2){
            if(Auth::user()->id_jabatan == 1 ){
                $user= User::where('id_jabatan', '!=' , 1)->get();
            }elseif(Auth::user()->id_jabatan == 2){
                $user= User::where([
                    ['id_jabatan', '!=' , 1],
                    ['id_jabatan', '!=' , 2],
                ])->get();
            }
            return view("/show_user")->with(compact('user'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }

    public function addUser(Request $request){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2){
            if($request->isMethod('POST')){
                $data=$request->all();

                $user= new User;
                $user->nama=$data['user_name'];
                $user->email=$data['user_email'];
                $user->password=Hash::make($data['user_pwd']);
                $user->id_jabatan=$data['user_role'];
                $user->no_telepon=$data['no_telp'];
                $user->save();
                return redirect("/user")->with('flash_message_success','User Added Successfully');

            }else{
                $role= Jabatan::get();
                return view('add_user')->with(compact('role'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }

    public function editUser(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2){
            $status=User::where(['id'=>$id])->first();
            if($status['id_jabatan']==1 || $status['id_jabatan']==2){
                return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
            }else{
               if($request->isMethod('POST')){
                $data=$request->all();

                if(empty($data['user_pwd'])){
                    User::where(['id'=>$id])->
                    update([
                        'nama'=>$data['user_name'],
                        'id_jabatan'=>$data['user_role'],
                        'no_telepon'=>$data['no_telp'],
                        'email'=>$data['user_email'] 
                    ]);
                    return redirect("/user")->with('flash_message_success','User Edited Successfully');
                }else{
                    User::where(['id'=>$id])->
                    update([
                        'nama'=>$data['user_name'],
                        'id_jabatan'=>$data['user_role'],
                        'no_telepon'=>$data['no_telp'], 
                        'email'=>$data['user_email'], 
                        'password'=>Hash::make($data['user_pwd'])
                    ]);
                    return redirect("/user")->with('flash_message_success','User Edited Successfully');
                }
            }else{
                $user= User::where(['id'=>$id])->first();
                $role= Jabatan::get();
                return view('edit_user')->with(compact('role', 'user'));
            }
        }           
    }else{
        return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
    }
}

    public function deleteUser(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2){
            $status=User::where(['id'=>$id])->first();
            if($status['id_jabatan']==1 || $status['id_jabatan']==2){
                return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
            }else{
            User::where(['id'=>$id])->delete();
            return redirect("/user")->with('flash_message_success','Delete User Successfully');
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }       
    }
}