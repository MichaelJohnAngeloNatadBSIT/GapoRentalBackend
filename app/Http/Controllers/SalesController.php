<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    //
    public function recordSale(Request $request, $schedule_id, $user_id, $product_id, $product_name, $product_price, $product_img, $post_user_id){
        // $request->validate([
        //     'schedule_date' => 'required',
        // ],
        // );
            Sales::create([
                'schedule_id' => $schedule_id,
                'user_id' => $user_id,
                'product_id' => $product_id,
                'post_user_id' => $post_user_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_img,
                'schedule_date' => $request->schedule_date,    
            ]);
            return response()->json($request);
    }

    // public function mail($email)
    // {
    //     Mail::to($email)->send(new ScheduleDone());
    //     return response()->json(["message" => "Email sent successfully."]);
    // }

    public function getSchedule(Request $request, $id){
        $schedules = Sales::select('*')->where('user_id', '=',$id)->get();

        return response()->json($schedules);
    }

    public function getScheduleWithPostUserId(Request $request, $id){
        $schedules = Sales::select('*')->where('post_user_id', '=',$id)->get();

        return response()->json($schedules);
    }

    public function deleteSchedule(Request $request, $schedule_id){  
        $schedules = Sales::select('*')->where('id', '=', $schedule_id)->delete();

        return response()->json($schedules);
    }

}
