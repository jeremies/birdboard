<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }


    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();
        $task = $project->tasks->first();

        $this->patch($task->path(), ['body' => 'changed', 'completed' => true])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed', 'completed' => true]);
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();
        $task = $project->tasks->first();

        $this->patch($task->path(), ['body' => 'changed']);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();
        $task = $project->tasks->first();

        $this->patch($task->path(), ['body' => 'changed', 'completed' => true]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->withTasks(1)->create();
        $task = $project->tasks->first();

        $this->patch($task->path(), ['body' => 'changed', 'completed' => true]);
        $this->patch($task->path(), ['body' => 'changed', 'completed' => false]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = Task::factory()->raw(['body' => '']);

        $this->actingAs($project->owner)->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
