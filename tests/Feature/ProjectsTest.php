<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * users can create projects.
     *
     * @test
     */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory('App\User')->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /**
     * only authenticated users can create projects.
     *
     * @test
     */

    public function guests_cannot_create_projects()
    {
        // $this->withoutExceptionHandling();

        $attributes = factory('App\Project')->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /**
     * only authenticated users can view projects.
     *
     * @test
     */

    public function guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /**
     * a user can view a project.
     *
     * @test
     */

    /**
     * only authenticated users can view their projects.
     *
     * @test
     */

    public function guests_cannot_view_a_single_project()
    {
        $project  = factory('App\Project')->create();

        $this->get($project->path())->assertRedirect('login');
    }

    /**
     * a user can view a project.
     *
     * @test
     */

    public function a_user_can_view_their_project()
    {
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
             ->assertSee($project->title)
             ->assertSee($project->description);
    }

    /**
     * a user cannot view other users projects
     *
     * @test
     */

    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create();

        $this->get($project->path())
             ->assertStatus(403);
    }

    /**
     * check title errors.
     *
     * @test
     */

    public function a_project_requires_a_title()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /**
     * check description errors.
     *
     * @test
     */

    public function a_project_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
