<?php

namespace Tests\Feature;

use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_activities(): void
    {
        Activity::create([
            'title' => 'Test Activity',
            'description' => 'Test description',
            'type' => 'note',
        ]);

        $response = $this->get(route('activities.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Activity');
    }

    public function test_create_displays_form(): void
    {
        $response = $this->get(route('activities.create'));

        $response->assertStatus(200);
        $response->assertSee('Add Activity');
    }

    public function test_store_creates_activity(): void
    {
        $response = $this->post(route('activities.store'), [
            'title' => 'New Activity',
            'description' => 'New description',
            'type' => 'milestone',
        ]);

        $response->assertRedirect(route('activities.index'));
        $this->assertDatabaseHas('activities', [
            'title' => 'New Activity',
            'type' => 'milestone',
        ]);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('activities.store'), []);

        $response->assertSessionHasErrors(['title', 'type']);
    }

    public function test_show_displays_activity(): void
    {
        $activity = Activity::create([
            'title' => 'Show Test',
            'description' => 'Show description',
            'type' => 'note',
        ]);

        $response = $this->get(route('activities.show', $activity));

        $response->assertStatus(200);
        $response->assertSee('Show Test');
    }

    public function test_edit_displays_form(): void
    {
        $activity = Activity::create([
            'title' => 'Edit Test',
            'description' => 'Edit description',
            'type' => 'note',
        ]);

        $response = $this->get(route('activities.edit', $activity));

        $response->assertStatus(200);
        $response->assertSee('Edit Activity');
    }

    public function test_update_modifies_activity(): void
    {
        $activity = Activity::create([
            'title' => 'Original Title',
            'description' => 'Original description',
            'type' => 'note',
        ]);

        $response = $this->put(route('activities.update', $activity), [
            'title' => 'Updated Title',
            'description' => 'Updated description',
            'type' => 'milestone',
        ]);

        $response->assertRedirect(route('activities.index'));
        $this->assertDatabaseHas('activities', [
            'id' => $activity->id,
            'title' => 'Updated Title',
            'type' => 'milestone',
        ]);
    }

    public function test_update_validates_required_fields(): void
    {
        $activity = Activity::create([
            'title' => 'Test',
            'type' => 'note',
        ]);

        $response = $this->put(route('activities.update', $activity), []);

        $response->assertSessionHasErrors(['title', 'type']);
    }

    public function test_destroy_deletes_activity(): void
    {
        $activity = Activity::create([
            'title' => 'Delete Test',
            'type' => 'note',
        ]);

        $response = $this->delete(route('activities.destroy', $activity));

        $response->assertRedirect(route('activities.index'));
        $this->assertDatabaseMissing('activities', [
            'id' => $activity->id,
        ]);
    }
}
