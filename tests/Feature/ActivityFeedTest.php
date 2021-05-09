<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Creating a project generates activity.
     *
     * @test
     */
    public function creating_a_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /**
     * Updating a project generates activity.
     *
     * @test
     */
    public function updating_a_project_generates_activity()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }
}
