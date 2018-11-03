<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    //显示
    public function index()
    {
        $activitys=Activity::where('end_time','>',time())->paginate(3);
        return view('activity.index',compact('activitys'));

    }
    //查看详情
    public function show(activity $activity)
    {
        return view('activity.show',compact('activity'));

    }

}
