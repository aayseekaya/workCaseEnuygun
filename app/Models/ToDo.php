<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ToDo
 * @package App\Models
 */
class ToDo extends Model
{
    protected $table = 'todos';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'level',
        'time'
    ];
    public $incrementing = false;
    const WEEKLY_WORKING_HOURS = 45;

    public function getWeekPlan($issueList, $developerList,$issueSum) {

       $averageTimeDuration=self::averageTimeDuration($developerList,$issueSum);
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
        return $result;

    }
    public function averageTimeDuration($developerList,$issueSum) {

        return round($issueSum / (self::WEEKLY_WORKING_HOURS * count($developerList)) );
        

    }

}
