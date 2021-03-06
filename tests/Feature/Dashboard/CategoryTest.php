<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\AdminUser;
use Tests\TestCase;
use App\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
    }

    /** @test */
    public function aCatagoryCanBeAddedToTheTableThroughTheForm()
    {
        $this->post('/dashboard/categories', [
            'title' => 'Airbus',
        ])
                ->assertRedirect('/dashboard/categories');
        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function titleFieldIsRequired()
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
    public function titleFieldShouldBeAtLeastTwoCharacters()
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
    public function titleFieldShouldBeMaxTenCharacters()
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
    public function aCategoryCanBeUpdated()
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
    public function aCategoryCanBeDeleted()
    {
        $category = factory(Category::class)->create();
        $this->assertCount(1, Category::all());
        $this->delete('/dashboard/categories/' . $category->id);
        $this->assertCount(0, Category::all());
        $this->assertDeleted($category);
    }
}
