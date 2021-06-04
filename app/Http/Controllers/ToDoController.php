<?php


namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Models\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\http;
use Illuminate\Support\Facades\DB;
class ToDoController extends Controller
{
    const WEEKLY_WORKING_HOURS = 45;

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
        $averageTimeDuration = round($issueSum / (self::WEEKLY_WORKING_HOURS * count($developerList)) );
        for ($week=1; $week<=$averageTimeDuration; $week++) {
            foreach ($developerList as $developer) {

                $hours = 0;
                foreach ($issueList as $key => $issue) {

                    if (
                        $hours + $issue["time"]<= self::WEEKLY_WORKING_HOURS
                        && $issue["level"] <= $developer->capacity_per_hour
                    ) {
                        $toDoList[$week][$developer->name][] = $issue["id"];
                        unset($issueList[$key]);
                        $hours += $issue["time"];
                    }
                }
            }
            if (empty($issueList)) {
                break;
            }
        }
        $result= [
            'duration' => $averageTimeDuration,
            'tasks' => $toDoList,
            'users' => $developerList,
        ];
        return view('tasklist', $result);
    }
}
