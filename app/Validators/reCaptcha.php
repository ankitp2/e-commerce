<?php
namespace App\Validators;

use GuzzleHttp\Client;

class reCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteveerify',
            [
                'form_params' =>
                    [
                        'secret' => config('services.recaptcha.secret'),
                        'response' => $value
                    ]
            ]
        );
        $body=json_decode((string)$response->getBody());
        return $body->success;
    }
}
?>
