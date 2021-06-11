<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ixudra\Curl\Facades\Curl;
use App\Interfaces\ProviderOneAdapter;
use App\Interfaces\ProviderTwoAdapter;
use App\Classes\IssueList;

class updateToDoList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todo:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'API\'lerden verileri çekerek to do listesini günceller';
    const PROVIDER_LIST = [
        ProviderOneAdapter::class,
        ProviderTwoAdapter::class
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    { 
        $list = [];
        foreach (self::PROVIDER_LIST as $provider) {
        $list = array_merge($list, (new IssueList(new $provider))->getAll());
        }
        foreach ($list as $index => $taskData) {
            $list[$index] = (object) [
                'level' => $taskData["difficulty"],
                'time'  => $taskData["timing"],
                'id'    => $taskData["name"],
            ];

        }
        IssueList::add($list);

    }


}
