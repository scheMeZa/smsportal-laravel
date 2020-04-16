<?php

namespace ScheMeZa\SMSPortal;

use Illuminate\Support\Facades\Http;

class SMSPortal
{
    /**
     * @param  string  $phoneNumber  This value is used to send the message to.
     * @param  string  $message  This value is used as the contents of the message sent to the phone number.
     * @return array The SMSPortal RESTful API Response.
     */
    public function sendMessage(string $phoneNumber, string $message)
    {
        $clientId   = config('smsportal.client_id');
        $secret     = config('smsportal.secret');
        $authBase64 = base64_encode("${clientId}:${secret}");

        $tokenResponse = Http::withHeaders(['Authorization' => "Basic ".$authBase64])
                             ->get('https://rest.smsportal.com/v1/authentication');

        if (! isset($tokenResponse['token'])) {
            abort(403, $tokenResponse['errors'][0]['errorMessage']);
        }

        $token = $tokenResponse['token'];

        return Http::withToken($token)
                   ->post("https://rest.smsportal.com/v1/bulkmessages", [
                       'messages' => [
                           [
                               'content'     => $message,
                               'destination' => $phoneNumber,
                           ],
                       ],
                   ])->json();
    }
}
