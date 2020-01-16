<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Histori_Ruangan;
use App\Jenis_Ruangan;
use App\Ruangan;
use Auth;

class RoomController extends Controller
{
    
//histoy_room
    public function roomHistory(){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2 ||
            Auth::user()->id_jabatan == 4 ){
            $histori_ruangan=Histori_Ruangan::orderBy('waktu', 'desc')->get();
            return view('room_history')->with(compact('histori_ruangan'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
}

    public function roomStatus(){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2||
            Auth::user()->id_jabatan == 4||
            Auth::user()->id_jabatan == 5  ){
            $status_ruangan=Ruangan::get();
        return view('room_status')->with(compact('status_ruangan'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
//add_room
    public function addRoom(Request $request){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2 ||
            Auth::user()->id_jabatan == 4 ){
            if($request->isMethod('POST')){
                $data=$request->all();

                $ruangan= new Ruangan;
                $ruangan->nama=$data['room_name'];
                $ruangan->id_jenis=$data['room_type'];
                $ruangan->status="Kosong";
                $ruangan->save();
                return redirect("/room_status")->with('flash_message_success','Room Added Successfully');

            }else{
                $jenis_ruangan= Jenis_Ruangan::get();
                return view('add_room')->with(compact('jenis_ruangan'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }

//edit_room
    public function editRoom(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2||
            Auth::user()->id_jabatan == 4 ){
            if($request->isMethod('POST')){
                $data=$request->all();
                Ruangan::where(['id'=>$id])->
                update([
                    'nama'=>$data['room_name'],
                    'id_jenis'=>$data['room_type']
                ]);

                return redirect("/room_status")->with('flash_message_success','Room Edited Successfully');
            }else{
                $ruangan= Ruangan::where(['id'=>$id])->first();
                $jenis_ruangan= Jenis_Ruangan::get();
                return view('edit_room')->with(compact('ruangan','jenis_ruangan'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
//delete_room
    public function deleteRoom(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2 ||
            Auth::user()->id_jabatan == 4 ){
            $status=Histori_Ruangan::where(['id_ruangan'=>$id])->first();
            if(empty($status)){
                Ruangan::where(['id'=>$id])->delete();
                return redirect("/room_status")->with('flash_message_success','Delete Room Successfully');
            }else{
                return redirect("/room_status")->with('flash_message_error','There is still Room in the History');
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    	
    }

    //edit_room_status
    public function editStatusRoom(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2||
            Auth::user()->id_jabatan == 4 || 
            Auth::user()->id_jabatan == 5){
            $status=Ruangan::where(['id'=>$id])->first();
            if($status['status']=="Kosong"){
                
                // echo $mytime->toDateTimeString();
                $ruangan= new Histori_Ruangan;
                $ruangan->id_ruangan=$status['id'];
                $ruangan->id_user=Auth::user()->id;
                $ruangan->status="Terisi";
                $ruangan->waktu=date('Y-m-d H:i:s');
                $ruangan->save();

                Ruangan::where(['id'=>$id])->
                update([
                    'status'=>'Terisi'
                ]);

                return redirect("/room_status")->with('flash_message_success','Room Status Edited Successfully');
            }else{
                
                $ruangan= new Histori_Ruangan;
                $ruangan->id_ruangan=$status['id'];
                $ruangan->id_user=Auth::user()->id;
                $ruangan->status="Kosong";
                $ruangan->waktu=date('Y-m-d H:i:s');
                $ruangan->save();

                Ruangan::where(['id'=>$id])->
                update([
                    'status'=>'Kosong'
                ]);
                return redirect("/room_status")->with('flash_message_success','Room Status Edited Successfully');
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    	
    }

    //off_room_status
    public function offRoom(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || 
            Auth::user()->id_jabatan == 2||
            Auth::user()->id_jabatan == 4|| 
            Auth::user()->id_jabatan == 5){
            $status=Ruangan::where(['id'=>$id])->first();
            $ruangan= new Histori_Ruangan;
            $ruangan->id_ruangan=$status['id'];
            $ruangan->id_user=Auth::user()->id;
            $ruangan->status="Tidak Tersedia";
            $ruangan->waktu=date('Y-m-d H:i:s');
            $ruangan->save();
        
            Ruangan::where(['id'=>$id])->
            update([
                'status'=>'Tidak Tersedia'
            ]);

            return redirect("/room_status")->with('flash_message_success','Room Status Edited Successfully');
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }    		
    }
}
