<?php

namespace Tests\Unit;

use App\Domain\TodoManager;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TodoManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_correctly_count_the_log_stat_of_the_user()
    {
        $user = factory(User::class)->create();
        Auth::loginUsingId($user->id);

        $manager = new TodoManager();

        $manager->add([
            'task' => 'Buy newspaper'
        ], $user->id);


        $this->assertEquals(1, $user->stats->count());
    }
}
