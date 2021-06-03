<?php


namespace App\Http\Controllers;


use App\Models\ToDo;
use App\Models\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\http;
use Illuminate\Support\Facades\DB;

class ProvidersController extends Controller
{
    const WEEKLY_WORKING_HOURS = 45;

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {    $providers=Providers::get();
        $toDoList = [];
        
        // for ($i=0; $i <count($providers) ; $i++) { 
            

        //     $response=http::get($providers[$i]->url);
            
            
        //     $provider2=$response->json();
        //     if($providers[$i]->name==="Provider 1"){
        //         foreach ($response->json()as $key => $value) {
        //             $todo=new Todo;
        //             $todo->id=$value["id"];
        //              $todo->level=$value["zorluk"];
        //              $todo->time=$value["sure"];
        //              $todo->save();
        //         }
        //         }
        //     else if($providers[$i]->name==="Provider 2"){
        //         foreach ($provider2 as $index => $taskData) {
                
        //             foreach ($taskData as $id => $taskProperty) {
        //                $todo=new Todo;
        //                $todo->id=$id;
        //                $todo->level=$taskProperty["level"];
        //                $todo->time=$taskProperty["estimated_duration"];
        //            $result= $todo->save();
        
        //             }
        
        //         }
        //     }
            
        // }

     //   $issueList = ToDo::all()->groupBy('level')->toArray();
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
