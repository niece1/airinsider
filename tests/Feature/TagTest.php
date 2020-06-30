<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Tag;

class TagTest extends TestCase
{
    use RefreshDatabase, AdminUser;
    
    /** @test */
    public function a_tag_can_be_added_to_the_table_through_the_form()
    {
        $this->actingAs($this->createAdminUser());
        $response = $this->post('/dashboard/tags', [
            'title' => 'Airbus',
        ]);
        $response->assertRedirect('/dashboard/tags');
        $this->assertCount(1, Tag::all());
    }
    
    /** @test */
    public function title_field_is_required() 
    {
        $this->actingAs($this->createAdminUser());
        $this->post('/dashboard/tags', [
            'title' => '',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Данное поле обязательно.');
    }
    
    /** @test */
    public function title_field_should_be_at_least_two_characters() 
    {
        $this->actingAs($this->createAdminUser());
        $this->post('/dashboard/tags', [
            'title' => 'A',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле должно быть мин 2 символа(ов).');
    }
    
    /** @test */
    public function title_field_should_be_max_ten_characters() 
    {
        $this->actingAs($this->createAdminUser());
        $this->post('/dashboard/tags', [
            'title' => 'Antananarivo',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле не должно быть больше 10 символа(ов).');
    }
    
    /** @test */
    public function a_tag_can_be_updated() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Tag::class)->create();
        $tag = Tag::first();
        $response = $this->patch('/dashboard/tags/' . $tag->id, [
            'title' => 'Airbus',
        ])->assertSessionHas('success_message');
        $this->assertEquals('Airbus', Tag::first()->title);
        $this->assertEquals(session('success_message'), 'Tag Updated Successfully!');
        $this->assertDatabaseMissing('tags', $tag->toArray());
        $this->assertDatabaseHas('tags', ['title' => 'Airbus']);
        $response->assertRedirect('/dashboard/tags/');
    }
    
    /** @test */
    public function a_tag_can_be_deleted()
    {
        $this->actingAs($this->createAdminUser());
        factory(Tag::class)->create();
        $this->assertCount(1, Tag::all());
        $tag = Tag::first();        
        $this->delete('/dashboard/tags/' . $tag->id);
        $this->assertCount(0, Tag::all());
        $this->assertDeleted($tag);
    }
}
