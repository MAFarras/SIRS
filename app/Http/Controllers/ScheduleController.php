<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Histori_Jadwal;
use App\Jadwal;
use App\Dokter;
use Auth;

class ScheduleController extends Controller
{

    //schedule_history
    public function scheduleHistory(){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            $histori_jadwal=Histori_Jadwal::orderBy('tanggal_waktu_buat', 'desc')->get();
            return view('schedule_history')->with(compact('histori_jadwal'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
    //doctor_schedule
    public function doctorSchedule(){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            $jadwal=Jadwal::orderBy('tanggal_mulai', 'desc')->get();
            return view('doctor_schedule')->with(compact('jadwal'));
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }
    //add_schedule
    public function addSchedule(Request $request){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            if($request->isMethod('POST')){
                $data=$request->all();

                $schedule= new Jadwal;
                $schedule->id_dokter=$data['dokter'];
                $schedule->tanggal_mulai=$data['from_date'];
                $schedule->tanggal_akhir=$data['until_date'];
                $schedule->waktu_mulai=$data['from_time'];
                $schedule->waktu_akhir=$data['until_time'];
                $schedule->save();

                $history_schedule= new Histori_Jadwal;
                $history_schedule->id_user=Auth::user()->id;
                $history_schedule->id_dokter=$data['dokter'];
                $history_schedule->tanggal_mulai=$data['from_date'];
                $history_schedule->tanggal_akhir=$data['until_date'];
                $history_schedule->waktu_mulai=$data['from_time'];
                $history_schedule->waktu_akhir=$data['until_time'];
                $history_schedule->tanggal_waktu_buat=date('Y-m-d H:i:s');
                $history_schedule->save();
                return redirect("/doctor_schedule")->with('flash_message_success','Room Added Successfully');

            }else{
                $dokter=Dokter::get();
                return view('add_schedule')->with(compact('dokter'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }

    }

    //edit
    public function editSchedule(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            if($request->isMethod('POST')){
                $data=$request->all();
                Jadwal::where(['id'=>$id])->
                update([
                    'id_dokter'=>$data['dokter'],
                    'tanggal_mulai'=>$data['from_date'],
                    'tanggal_akhir'=>$data['until_date'],
                    'waktu_mulai'=>$data['from_time'],
                    'waktu_akhir'=>$data['until_time']
                ]);

                $history_schedule= new Histori_Jadwal;
                $history_schedule->id_user=Auth::user()->id;
                $history_schedule->id_dokter=$data['dokter'];
                $history_schedule->tanggal_mulai=$data['from_date'];
                $history_schedule->tanggal_akhir=$data['until_date'];
                $history_schedule->waktu_mulai=$data['from_time'];
                $history_schedule->waktu_akhir=$data['until_time'];
                $history_schedule->tanggal_waktu_buat=date('Y-m-d H:i:s');
                $history_schedule->save();

                return redirect("/doctor_schedule")->with('flash_message_success','Room Edited Successfully');
            }else{
                $jadwal=Jadwal::where(['id'=>$id])->first();
                $dokter=Dokter::get();
                return view('edit_schedule')->with(compact('jadwal','dokter'));
            }
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }

    //delete
    public function deleteSchedule(Request $request, $id=null){
        if(Auth::user()->id_jabatan == 1 || Auth::user()->id_jabatan == 2 || Auth::user()->id_jabatan == 3){
            Jadwal::where(['id'=>$id])->delete();
            return redirect("/doctor_schedule")->with('flash_message_success','Delete Schedule Successfully');
        }else{
            return redirect("/forbidden")->with('flash_message_error','Forbidden Access');
        }
    }    
}
