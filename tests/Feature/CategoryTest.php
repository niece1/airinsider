<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\AdminUser;
use Tests\TestCase;
use App\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase, AdminUser;

    public function setUp(): void
    {
        parent::setUp();  
        $this->actingAs($this->createAdminUser());
    }    
    
    /** @test */
    public function a_catagory_can_be_added_to_the_table_through_the_form()
    {
        $this->post('/dashboard/categories', [
            'title' => 'Airbus',
        ])
                ->assertRedirect('/dashboard/categories');
        $this->assertCount(1, Category::all());
    }
    
    /** @test */
    public function title_field_is_required() 
    {
        $this->post('/dashboard/categories', [
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
        $this->post('/dashboard/categories', [
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
        $this->post('/dashboard/categories', [
            'title' => 'Antananarivo',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле не должно быть больше 10 символа(ов).');
    }
    
    /** @test */
    public function a_category_can_be_updated() 
    {
        $category = factory(Category::class)->create();
        $this->patch('/dashboard/categories/' . $category->id, [
            'title' => 'Airbus',
        ])
                ->assertSessionHas('success_message')
                ->assertRedirect('/dashboard/categories/');
        $this->assertEquals('Airbus', Category::first()->title);
        $this->assertEquals(session('success_message'), 'Category Updated Successfully!');
        $this->assertDatabaseMissing('categories', $category->toArray());
        $this->assertDatabaseHas('categories', ['title' => 'Airbus']);
    }
    
    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();
        $this->assertCount(1, Category::all());       
        $this->delete('/dashboard/categories/' . $category->id);
        $this->assertCount(0, Category::all());
        $this->assertDeleted($category);
    }
}
