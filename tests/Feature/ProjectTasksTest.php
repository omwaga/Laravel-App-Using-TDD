<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Project;

class ProjectTasksTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A project can have tasks.
     *
     * @test
     */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->post($project->path().'/tasks', ['body' => 'task body']);

        $this->get($project->path())
             ->assertSee('task body');
    }

    /**
     * only the owner of a project may add task.
     *
     * @test
     */

    public function only_the_owner_of_a_project_may_add_task()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post($project->path().'/tasks', ['body' => 'task body'])
             ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'task body']);
    }

    /**
     * a atask requires a bosy.
     *
     * @test
     */

    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
