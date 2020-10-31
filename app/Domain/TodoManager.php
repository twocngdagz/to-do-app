<?php

namespace App\Domain;

use App\Domain\ToDo;
use App\Task;
use App\User;

class TodoManager implements ToDo
{
    public function user($userId)
    {
        $this->userId = $userId;
    }

    public function add($data, $userId)
    {
        $task = Task::create([
            'description' => $data['task'],
            'is_done' => false,
            'user_id' => $userId
        ]);

        if ($task) {
            $this->logStat($userId);
            return $task;
        }
    }

    public function toggle($taskId)
    {
        $task = Task::findOrFail($taskId);

        $task->is_done = !$task->is_done;
        $task->save();

        $this->logStat($task->user->id);

        return $task;
    }

    protected function logStat($userId)
    {
        $user = User::findOrFail($userId);
        $user->logStat();
    }

    public function delete($taskId)
    {
        $task = Task::findOrFail($taskId);
        $userId = $task->user->id;
        $task->delete();
        $this->logStat($userId);
    }
}
