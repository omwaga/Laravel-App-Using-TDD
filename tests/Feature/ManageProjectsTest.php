<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;

use App\Project;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * users can create projects.
     *
     * @test
     */
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here.',
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->get($project->path())
             ->assertSee($attributes['title'])
             ->assertSee($attributes['description'])
             ->assertSee($attributes['notes']);
    }

    /**
     * a user can update a project.
     *
     * @test
     */

    public function a_user_can_update_a_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
             ->patch($project->path(), $attributes = ['title' => 'Changed', 'description' => 'Changed' , 'notes' => 'Changed'])
             ->assertRedirect($project->path());

        $this->get($project->path().'/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    /**
     * only authenticated users can control projects.
     *
     * @test
     */

    public function guests_cannot_control_projects()
    {
        $attributes = factory('App\Project')->raw();

        $project  = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /**
     * a user can view a project.
     *
     * @test
     */

    public function a_user_can_view_their_project()
    {
        // $this->be(factory('App\User')->create());

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
             ->get($project->path())
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
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())
             ->assertStatus(403);
    }

    /**
     * a user cannot update other users projects
     *
     * @test
     */

    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->patch($project->path())
             ->assertStatus(403);
    }

    /**
     * check title errors.
     *
     * @test
     */

    public function a_project_requires_a_title()
    {
        $this->signIn();

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
        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
