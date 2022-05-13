<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller
{
    //
    public function schedule(Request $request, $user_id, $product_id, $product_name, $product_price, $product_img){
        $request->validate([
            'schedule_date' => 'required',
        ],
    );
            Schedule::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_img,
                'schedule_date' => $request->schedule_date,
                
            ]);
            return response()->json($request);
    }

    public function getSchedule(Request $request, $id){
        $schedules = Schedule::select('*')->where('user_id', '=',$id)->get();

        return response()->json($schedules);
    }
}
