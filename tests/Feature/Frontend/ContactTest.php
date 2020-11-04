<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contactPageWorksCorrectly()
    {
        $this->get('/contact')
                ->assertSeeText('Заполните форму')
                ->assertSeeText('Напишите нам');
    }

    /** @test */
    public function aUserCanSendMailThroughTheForm()
    {
        $this->post('contact', $this->createContactAttributes())
                ->assertStatus(302)
                ->assertSessionHas('success');
        $this->assertEquals(session('success'), 'Сообщение успешно отправлено.'
                . ' Ожидайте ответ.');
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
        $this->assertEquals($messages['name'][0], 'Данное поле обязательно.');
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
        $this->assertEquals($messages['name'][0], 'Поле должно быть мин 2 символа(ов).');
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
        $this->assertEquals($messages['email'][0], 'Поле должно быть корректным.');
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
        $this->assertEquals($messages['message'][0], 'Данное поле обязательно.');
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
