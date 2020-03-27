<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Description of RecaptchaService
 *
 * @author test
 */
class RecaptchaService {
    
    public function validateCaptcha() 
    {        
        $token = filter_input(INPUT_POST, 'g-token', FILTER_SANITIZE_STRING);
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => array(
                'secret' => config('app.recaptcha.secret'),
                'response' => $token,
            )
        ]);
        
        return  json_decode($response->getBody())->success;        
    }
}
