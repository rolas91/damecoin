<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($value){

        $client = new Client();

        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6LeNLlwaAAAAAH_YPePul3UOTz8Nn2n_8VGLzgsO',
                    'response'=>$value,
                    'remoteip' => $_SERVER['REMOTE_ADDR']
                 ]
            ]
        );

        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

}