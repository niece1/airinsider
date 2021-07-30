<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\Traits\AdminUser;
use App\Models\Category;
use App\Models\Post;
use App\Models\Photo;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        Category::factory()->create();
        Storage::fake('public');
    }

    /** @test */
    public function postPhotoUploadedSuccessfully()
    {
        $file = UploadedFile::fake()->image('logo.jpg');
        $this->createPost($file);
        $this->assertDirectoryExists('public');
        $this->assertDirectoryIsReadable('public');
        $this->assertDirectoryIsWritable('public');
        Storage::disk('public')->assertExists('photos/' . $file->hashName());
        $this->assertFileExists('public');
        $this->assertFileIsReadable('public');
        $this->assertFileIsWritable('public');
    }

    /** @test */
    public function postPhotoUploadFailsIfImageSizeMoreThan5Mb()
    {
        $file = UploadedFile::fake()->image('logo.jpg')->size(6000);
        $this->createPost($file);
        Storage::disk('public')->assertMissing('posts/' . $file->hashName());
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['image'][0], 'The image may not be greater than 5000 kilobytes.');
    }

    /** @test */
    public function postPhotoUploadFailsIfFileIsNotImage()
    {
        $file = UploadedFile::fake()->image('logo.pdf');
        $this->createPost($file);
        Storage::disk('public')->assertMissing('posts/' . $file->hashName());
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['image'][0], 'The image must be an image.');
    }

    /** @test */
    public function aPostMorphsOnePhoto()
    {
        $photo = UploadedFile::fake()->image('logo.jpg');
        $this->createPost($photo);
        $post = Post::first();
        $this->assertInstanceOf(Photo::class, $post->photo);
        $this->assertTrue($post->photo()->exists());
    }

    /**
     * Creates post with uploaded file
     *
     * @param type $file
     * @return array
     */
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
