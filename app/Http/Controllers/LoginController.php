<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\User;
use App\Dokter;
use App\Jenis_Dokter;
use App\Ruangan;
use App\Jadwal;

class LoginController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->input();
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
    		
                return redirect('/dashboard');
    		}else{
                return redirect('/login')->with('flash_message_error','Invalid Username or Password');
            }
    	}
    	
    	return view('login');
    }

    public function index(){
        $specialization= Jenis_Dokter::count();
        $doctor= Dokter::count();
        if(Auth::user()->id_jabatan == 1 ){
            $user= User::where('id_jabatan', '!=' , 1)->count();
        }elseif(Auth::user()->id_jabatan == 2){
            $user= User::where([
                ['id_jabatan', '!=' , 1],
                ['id_jabatan', '!=' , 2],
            ])->count();
        }
        $room= Ruangan::where(['status'=>"Kosong"])->count();
    	return view('dashboard.dashboard')->with(compact('specialization', 'doctor', 'user', 'room'));
    }

    public function logout(){
        Session::flush();
        return redirect('/login')->with('flash_message_success','Logged Out Succesfully');
    }

    public function editProfile(Request $request, $id=null){
        if($request->isMethod('POST')){
            $id=Auth::user()->id_jabatan;
            $data=$request->all();

            if(empty($data['user_pwd'])){
                User::where(['id'=>$id])->
                update([
                    'nama'=>$data['user_name'],
                    'no_telepon'=>$data['no_telp'],
                    'email'=>$data['user_email'] 
                ]);
                return redirect("/dashboard")->with('flash_message_success','User Edited Successfully');
            }else{
                User::where(['id'=>$id])->
                update([
                    'nama'=>$data['user_name'],
                    'no_telepon'=>$data['no_telp'], 
                    'email'=>$data['user_email'], 
                    'password'=>Hash::make($data['user_pwd'])
                ]);
                return redirect("/dashboard")->with('flash_message_success','User Edited Successfully');
            }
        }else{
            return view('edit_profile');
        }
    }

    public function forbidden(){
        return view('forbiden_access');
    }

    public function doctor_schedule(){
        $jadwal= Jadwal::get();
        return view('doctor_view_schedule')->with(compact('jadwal'));
    }
}
