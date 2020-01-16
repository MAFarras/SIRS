<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis_Dokter;
use App\Dokter;
use Auth;

class SpecializationController extends Controller
{
//specialization
    public function showSpecialization(){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            $field=Jenis_Dokter::get();
            return view('specialization')->with(compact('field'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }

    }
//add
    public function addSpecialization(Request $request){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            if($request->isMethod('POST')){
                $data=$request->all();

                $jenis_dokter= new Jenis_Dokter;
                $jenis_dokter->nama=$data['field_name'];
                $jenis_dokter->keterangan=$data['field_definition'];
                $jenis_dokter->save();
                return redirect("/specialization")->with('flash_message_success','Specialization Added Successfully');

            }else{
                $specialization= Jenis_Dokter::get();
                return view('add_specialization')->with(compact('specialization'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }

    }

//edit
    public function editSpecialization(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            if($request->isMethod('POST')){
                $data=$request->all();
                Jenis_Dokter::where(['id'=>$id])->
                update([
                    'nama'=>$data['field_name'],
                    'keterangan'=>$data['field_definition']
                ]);

                return redirect("/specialization")->with('flash_message_success','Specialization Edited Successfully');
            }else{
                $specialization= Jenis_Dokter::where(['id'=>$id])->first();
                return view('edit_specialization')->with(compact('specialization'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }

    }
//delete
    public function deleteSpecialization(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            $status=Dokter::where(['id_jenis'=>$id])->first();
            if(empty($status)){
                Jenis_Dokter::where(['id'=>$id])->delete();
                return redirect("/specialization")->with('flash_message_success','Delete Specialization Successfully');
            }else{
                return redirect("/specialization")->with('flash_message_error','There is still doctor with the specialization');
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
}
