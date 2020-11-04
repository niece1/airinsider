<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Tag;

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
        $this->post('/dashboard/tags', ['title' => 'Airbus',])
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
        $this->assertEquals($messages['title'][0], 'Данное поле обязательно.');
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
        $this->assertEquals($messages['title'][0], 'Поле должно быть мин 2 символа(ов).');
    }

    /** @test */
    public function titleFieldShouldBeMaxTenCharacters()
    {
        $this->post('/dashboard/tags', ['title' => 'Antananarivo',])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле не должно быть больше 10 символа(ов).');
    }

    /** @test */
    public function aTagCanBeUpdated()
    {
        $tag = factory(Tag::class)->create();
        $this->patch('/dashboard/tags/' . $tag->id, ['title' => 'Airbus',])
                ->assertSessionHas('success_message')
                ->assertRedirect('/dashboard/tags/');
        $this->assertEquals('Airbus', Tag::first()->title);
        $this->assertEquals(session('success_message'), 'Tag Updated Successfully!');
        $this->assertDatabaseMissing('tags', $tag->toArray());
        $this->assertDatabaseHas('tags', ['title' => 'Airbus']);
    }

    /** @test */
    public function aTagCanBeDeleted()
    {
        $tag = factory(Tag::class)->create();
        $this->assertCount(1, Tag::all());
        $this->delete('/dashboard/tags/' . $tag->id);
        $this->assertCount(0, Tag::all());
        $this->assertDeleted($tag);
    }
}
