<?php

namespace App\Domain;

interface ToDo
{
    public function add($data, $userId);

    public function toggle($taskId);

    public function delete($taskId);
}
