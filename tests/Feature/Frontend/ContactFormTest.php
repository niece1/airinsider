<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contactPageWorksCorrectly()
    {
        $this->get('/contact')
                ->assertSeeText('Fill in the form')
                ->assertSeeText('Get in touch');
    }

    /** @test */
    public function aUserCanSendMailThroughTheForm()
    {
        $this->post('contact', $this->createContactAttributes())
                ->assertStatus(302)
                ->assertSessionHas('success');
        $this->assertEquals(session('success'), 'Your message send successfully.');
    }

    /** @test */
    public function toSendMailANameFieldIsRequired()
    {
        $this->post('contact', array_merge($this->createContactAttributes(), [
            'name' => '',
        ]))
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['name'][0], 'The name field is required.');
    }

    /** @test */
    public function toSendMailNameShouldBeAtLeastTwoCharacters()
    {
        $this->post('contact', array_merge($this->createContactAttributes(), [
            'name' => 'A',
        ]))
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['name'][0], 'The name must be at least 2 characters.');
    }

    /** @test */
    public function toSendMailAnEmailFieldShouldBeAValidEmail()
    {
        $this->post('contact', array_merge($this->createContactAttributes(), [
            'email' => 'airinsider',
        ]))
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'The email must be a valid email address.');
    }

    /** @test */
    public function toSendMailAMessageIsRequired()
    {
        $this->post('contact', array_merge($this->createContactAttributes(), [
            'message' => '',
        ]))
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['message'][0], 'The message field is required.');
    }

    /**
     * Creates attributes for contact query
     *
     * @return array
     */
    private function createContactAttributes()
    {
        return [
            'name' => 'Anna',
            'email' => 'airinsider@gmail.com',
            'message' => 'Hello airinsider',
        ];
    }
}
