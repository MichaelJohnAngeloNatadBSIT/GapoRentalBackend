<?php

namespace App\Http\Controllers;
use App\Models\AcceptedSchedule;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AcceptedScheduleController extends Controller
{
    //

    public function createAcceptedSchedule(Request $request, $user_id, $product_id, $schedule_id, $post_user_id, $schedule_date){
        
        // $temp_user_id = $user_id;
        // $temp_product_id = $product_id;
        // $temp_schedule_id = $schedule_id;
        // $temp_post_user_id = $post_user_id;
        // $temp_schedule_date = $schedule_date; 

        $accepted_sched = AcceptedSchedule::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'schedule_id' => $schedule_id,
            'post_user_id' => $post_user_id,
            'schedule_date' => $schedule_date,

        ]);

        Schedule::select('*')->where('id', '=', $schedule_id)->update([
            'status' => 'approved',
        ]);





        
        // $accepted_sched->save();

        // DB::select('select * from schedules ')->where('id', '=', $schedule_id)->delete();
        // $old_sched_record = Schedule::select('*')->where('id', '=', $schedule_id);
        // $old_sched_record->delete();
       
        return response()->json($request);
        // return Schedule::select('*')->where('id', '=', $schedule_id)->delete();

    }

    
    public function getAcceptedScheduleById(Request $request, $id){
        $schedules = AcceptedSchedule::select('*')->where('user_id', '=',$id)->get();

        return response()->json($schedules);
    }
}
