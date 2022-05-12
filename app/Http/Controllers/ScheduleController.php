<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;


class ScheduleController extends Controller
{
    //
    public function schedule(Request $request, $user_id, $product_id){
        $request->validate([
            'schedule_date' => 'required',
        ],
    );
            Schedule::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'schedule_date' => $request->schedule_date,
                
            ]);
            return response()->json($request);
    }
}
