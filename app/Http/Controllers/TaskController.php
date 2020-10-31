<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function get()
    {
        return auth()->user()->tasks;
    }

    public function toggle(Task $task)
    {
        $task->is_done = !$task->is_done;
        $task->save();

        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
    }

    public function inComplete()
    {
        $dataCollection = collect(CarbonPeriod::create(Carbon::now()->subHour(), '1 minute', Carbon::now()))->map(function ($period) {

            $periodStat = auth()->user()->stats->filter(function ($stat) use ($period) {
                $dateFrom = $period->toDateTimeString();
                $dateTo = $period->addSecond(59)->toDateTimeString();
                $base = $stat->created_at->toDateTimeString();

                return Carbon::parse($base)->between(Carbon::parse($dateFrom), Carbon::parse($dateTo));
            })->last();

            return [
                'label' => $period->toDateTimeString(),
                'count' => $periodStat->incomplete ?? 0
            ];
        })->toArray();

        return [
            'labels' => array_column($dataCollection, 'label'),
            'datasets' => [
                [
                    'label' => 'Incomplete Task',
                    'pointRadius', 10,
                    'data' => array_column($dataCollection, 'count'),
                    'borderColor' => '#5E9732',
                    'backgroundColor' => '#c7ecea',
                    'pointColor' => '#226D82',
                    'pointBorderWidth' => 2,
                    'pointBorderColor' => '#5E9732',
                    'strokeColor' => 'rgba(151,187,205,1)'
                ]
            ]
        ];
    }

    public function create(Request $request)
    {
        $task = Task::create([
            'description' => $request->get('task'),
            'is_done' => false,
            'user_id' => auth()->user()->id
        ]);

        if ($task) {
            $request->user()->stats()->create([
                'incomplete' => $request->user()->tasks()->where('is_done', false)->count()
            ]);

            return $task;
        }
    }
}
