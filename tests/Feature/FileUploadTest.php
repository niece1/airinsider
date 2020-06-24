<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Category;
use Tests\Feature\FeatureTestCase;

class FileUploadTest extends FeatureTestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function post_photo_uploaded_successfully()
    {
        $this->actingAs($this->create_admin_user());
        Storage::fake('public');
        factory(Category::class)->create();
        $file = UploadedFile::fake()->image('logo.jpg');
        $this->createPost($file);
        Storage::disk('public')->assertExists('posts/' . $file->hashName());
    }
    
    /** @test */
    public function post_photo_upload_fails_if_image_size_more_than_5mb()
    {
        $this->actingAs($this->create_admin_user());
        Storage::fake('public');
        factory(Category::class)->create();
        $file = UploadedFile::fake()->image('logo.jpg')->size(6000);
        $this->createPost($file);
        Storage::disk('public')->assertMissing('posts/' . $file->hashName());
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['image'][0], 'Файл не должен быть больше 5000 килобайт.');
    }
    
    /** @test */
    public function post_photo_upload_fails_if_file_is_not_image()
    {
        $this->actingAs($this->create_admin_user());
        Storage::fake('public');
        factory(Category::class)->create();
        $file = UploadedFile::fake()->image('logo.pdf');
        $this->createPost($file);
        Storage::disk('public')->assertMissing('posts/' . $file->hashName());
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['image'][0], 'Файл должен быть изображением.');
    }
    
    private function createPost($file)
    {
        return $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
            'image' => $file,
        ]);
    }
}
