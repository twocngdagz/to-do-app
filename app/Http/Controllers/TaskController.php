<?php

namespace App\Http\Controllers;

use App\Domain\ToDo;
use App\Task;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected $manager;

    public function __construct(ToDo $manager)
    {
        $this->manager = $manager;
    }

    public function get()
    {
        return auth()->user()->tasks;
    }

    public function toggle(Task $task)
    {
        return $this->manager->toggle($task->id);
    }

    public function delete(Task $task)
    {
        return $this->manager->delete($task->id);
    }

    public function inComplete()
    {
        $dataCollection = collect(CarbonPeriod::create(Carbon::now()->subHour()->subSeconds(60)->startOfMinute(), '1 minute', Carbon::now()->startOfMinute()))->map(function ($period) {

            $periodStat = auth()->user()->stats->filter(function ($stat) use ($period) {
                return $stat->created_at->between($period, $period->copy()->addSecond(60));
            })->last();

            if ($periodStat) {
                return [
                    'label' => $period->format('g:i:s a'),
                    'count' => $periodStat->incomplete ?? 0
                ];
            }
        })->toArray();

        return [
            'labels' => array_column($dataCollection, 'label'),
            'datasets' => [
                [
                    'label' => 'Incomplete Task',
                    'pointRadius', 10,
                    'data' => array_column($dataCollection, 'count'),
                    'borderColor' => '#121EE9',
                    'backgroundColor' => '#966bcf',
                    'pointColor' => '#3398ED',
                    'pointBorderWidth' => 2,
                    'pointBorderColor' => '#412145',
                    'strokeColor' => 'rgba(128,111,213,1)'
                ]
            ]
        ];
    }

    public function create(Request $request)
    {
        return $this->manager->add($request->all(), $request->user()->id);
    }
}
