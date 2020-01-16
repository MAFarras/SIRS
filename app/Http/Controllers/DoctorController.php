<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis_Dokter;
use App\Dokter;
use Auth;

class DoctorController extends Controller
{
//doctor
    public function showDokter(){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            $doctor=Dokter::get();
            return view('doctor')->with(compact('doctor'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
//add_doctor
    public function addDokter(Request $request){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            if($request->isMethod('POST')){
                $data=$request->all();

                $dokter= new Dokter;
                $dokter->nama=$data['doctor_name'];
                $dokter->id_jenis=$data['specialization'];
                $dokter->no_telp=$data['doctor_phone_number'];
                $dokter->no_praktek=$data['practical_number'];
                $dokter->save();
                return redirect("/dokter")->with('flash_message_success','User Added Successfully');

            }else{
                $specialization= Jenis_Dokter::get();
                return view('add_doctor')->with(compact('specialization'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }

    }
//edit
    public function editDoctor(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            if($request->isMethod('POST')){
                $data=$request->all();
                Dokter::where(['id'=>$id])->
                update([
                    'nama'=>$data['doctor_name'],
                    'id_jenis'=>$data['specialization'],
                    'no_telp'=>$data['doctor_phone_number'],
                    'no_praktek'=>$data['practical_number'] 
                ]);

                return redirect("/dokter")->with('flash_message_success','Doctor Edited Successfully');
            }else{
                $doctor= Dokter::where(['id'=>$id])->first();
                $specialization= Jenis_Dokter::get();
                return view('edit_doctor')->with(compact('specialization', 'doctor'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
//delete
    public function deleteDoctor(Request $request, $id=null){
      if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
        Dokter::where(['id'=>$id])->delete();
        return redirect("/dokter")->with('flash_message_success','Delete Doctor Successfully');
    }else{
        return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
    } 
}

}
