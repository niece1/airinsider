<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactTest extends TestCase
{

    /** @test */
    public function a_user_can_send_mail_through_the_form()
    {
        $this->post('contact', [
            'name' => 'Anna',
            'email' => 'airinsider@gmail.com',
            'message' => 'Hello airinsider',
        ])
                ->assertStatus(302)
                ->assertSessionHas('success');
        $this->assertEquals(session('success'), 'Сообщение успешно отправлено. Ожидайте ответ.');      
    }
    
    /** @test */
    public function to_send_mail_a_name_field_is_required()
    {
        $this->post('contact', [
            'name' => '',
            'email' => 'airinsider@gmail.com',
            'message' => 'Hello airinsider',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['name'][0], 'Данное поле обязательно.');      
    }
    
    /** @test */
    public function to_send_mail_name_should_be_at_least_two_characters()
    {
        $this->post('contact', [
            'name' => 'A',
            'email' => 'airinsider@gmail.com',
            'message' => 'Hello airinsider',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['name'][0], 'Поле должно быть мин 2 символа(ов).');      
    }
    
    /** @test */
    public function to_send_mail_an_email_field_should_be_a_valid_email()
    {
        $this->post('contact', [
            'name' => 'Anna',
            'email' => 'airinsider',
            'message' => 'Hello airinsider',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['email'][0], 'Поле должно быть корректным.');      
    }
    
    /** @test */
    public function to_send_mail_a_message_is_required()
    {
        $this->post('contact', [
            'name' => 'Anna',
            'email' => 'airinsider@gmail.com',
            'message' => '',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['message'][0], 'Данное поле обязательно.');      
    }
}
