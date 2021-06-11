<?php


namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Models\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\http;
use Illuminate\Support\Facades\DB;
class ToDoController extends Controller
{


    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {   
        $toDoList = [];
        
        $issueList = ToDo::orderBy('level', 'DESC') ->get()->toArray();
        $developerList=DB::table('developer')->get();
        $issueSum=ToDo::sum('time');
        $plan = new ToDo();

        $result = $plan->getWeekPlan($issueList,$developerList,$issueSum);

        return view('tasklist', $result);
    }
}
