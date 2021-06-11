<?php

namespace App\Classes;

use App\Interfaces\ProviderAdaptorInterface;
use App\Models\ToDo as ToDoModel;

class IssueList
{
    private $providerAdaptor;

    public function __construct(ProviderAdaptorInterface $providerAdaptor)
    {
        $this->providerAdaptor = $providerAdaptor;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->providerAdaptor->getIssueList();
    }
       /**
     * @param  array  $toDoList
     */
    public static function add(array $toDoList = [])
    { 
        foreach ($toDoList as $todo) {
            ToDoModel::updateOrCreate(
                [
                    'id' => $todo->id,
                ],
                [
                    'time'  => $todo->time,
                    'level' => $todo->level,
                ]
            );
        }
    }
}
