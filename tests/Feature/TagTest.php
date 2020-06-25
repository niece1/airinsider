<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\FeatureTestCase;
use App\Tag;

class TagTest extends FeatureTestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_tag_can_be_added_to_the_table_through_the_form()
    {
        $this->actingAs($this->create_admin_user());
        $response = $this->post('/dashboard/tags', [
            'title' => 'Airbus',
        ]);
        $response->assertRedirect('/dashboard/tags');
        $this->assertCount(1, Tag::all());
    }
    
    /** @test */
    public function title_field_is_required() 
    {
        $this->actingAs($this->create_admin_user());
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
        $this->actingAs($this->create_admin_user());
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
        $this->actingAs($this->create_admin_user());
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
        $this->actingAs($this->create_admin_user());
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
}
