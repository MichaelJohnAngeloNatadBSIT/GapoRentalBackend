<?php

namespace App\Http\Controllers;
use App\Models\AcceptedSchedule;
use App\Models\Schedule;

use Illuminate\Http\Request;

class AcceptedScheduleController extends Controller
{
    //

    public function createAcceptedSchedule(Request $request, $user_id, $product_id, $schedule_id, $schedule_date){
        AcceptedSchedule::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'schedule_id' => $schedule_id,
            'schedule_date' => $schedule_date,
        ]);
        return response()->json($request);

    }

}
