<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Models\Tag;

class TagTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
    }

    /** @test */
    public function aTagCanBeAddedToTheTableThroughTheForm()
    {
        $this->post('/dashboard/tags', ['title' => 'airbus',])
                ->assertRedirect('/dashboard/tags');
        $this->assertCount(1, Tag::all());
    }

    /** @test */
    public function titleFieldIsRequired()
    {
        $this->post('/dashboard/tags', [
            'title' => '',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title field is required.');
    }

    /** @test */
    public function titleFieldShouldBeAtLeastTwoCharacters()
    {
        $this->post('/dashboard/tags', [
            'title' => 'A',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 2 characters.');
    }

    /** @test */
    public function titleFieldShouldBeMaxTenCharacters()
    {
        $this->post('/dashboard/tags', ['title' => 'Antananarivo',])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title may not be greater than 10 characters.');
    }

    /** @test */
    public function aTagCanBeUpdated()
    {
        $tag = Tag::factory()->create();
        $this->patch('/dashboard/tags/' . $tag->id, ['title' => 'airbus',])
                ->assertSessionHas('success_message')
                ->assertRedirect('/dashboard/tags/');
        $this->assertEquals('airbus', Tag::first()->title);
        $this->assertEquals(session('success_message'), 'Tag Updated Successfully!');
        $this->assertDatabaseMissing('tags', $tag->toArray());
        $this->assertDatabaseHas('tags', ['title' => 'airbus']);
    }

    /** @test */
    public function aTagCanBeDeleted()
    {
        $tag = Tag::factory()->create();
        $this->assertCount(1, Tag::all());
        $this->delete('/dashboard/tags/' . $tag->id);
        $this->assertCount(0, Tag::all());
        $this->assertModelMissing($tag);
    }
}
