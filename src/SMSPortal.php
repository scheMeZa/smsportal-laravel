<?php

namespace ScheMeZa\SMSPortal;

use ScheMeZa\SMSPortal\EmptyPhoneNumber;

use Illuminate\Support\Facades\Http;

class SMSPortal
{

    private function replacements(string $message, array $replacements)
    {

        if (empty($replacements)) {
            return $message;
        }

        foreach ($replacements as $replacement) {
            $message = str_replace($replacement["key"], $replacement["value"], $message);
        }

        return $message;

    }


    /**
     * @param  string|array $phoneNumber This value is used to send the message(s) to.
     * @param  string $message This value is used as the contents of the message sent to the phone number(s).
     * @param  array $replacements Optional replacement values when sending to multiple phoneNumbers (eg $replacements[ ["key"=>"value ] ]). If set the number of replacements must be equal to the number of phoneNumbers
     * @return array The SMSPortal RESTful API Response.
     */
    public function sendMessage(string|array $phoneNumber, string $message, array $replacements=[])
    {
        $clientId   = config('smsportal.client_id');
        $secret     = config('smsportal.secret');
        $authBase64 = base64_encode("$clientId:$secret");

        $tokenResponse = Http::withHeaders(['Authorization' => "Basic ".$authBase64])
                             ->get('https://rest.smsportal.com/v1/authentication');

        if (! isset($tokenResponse['token'])) {
            abort(403, $tokenResponse['errors'][0]['errorMessage']);
        }

        $token = $tokenResponse['token'];

        $messages = [];
    
        if (gettype($phoneNumber) === "string") {

            if (count($replacements) !== 0) {
                throw new ReplacementsException("You cannot use replacements when sending a single SMS", 1001);
            }

            if ($phoneNumber == "") {
                throw new EmptyPhoneNumberException("Phone Number is empty.", 3001);
            }

            $message = $this->replacements($message, $replacements);

            $messages[] = [
                'content'     => $message,
                'destination' => $phoneNumber,
            ];
        } else if (gettype($phoneNumber) === "array") {

            if (!empty($replacements)) {
                if (count($replacements) !== count($phoneNumber)) {
                    throw new ReplacementsException("The number of replacements is not the same as the number of phoneNumbers", 1002);
                }
            }


            if (count($phoneNumber) > 100) {
                throw new LimitExceededException("Error, SMS Portal has a limit of 100 messages per batch. Please batch your sends and try again.");
            }

            if (count($phoneNumber) == 0) {
                throw new EmptyPhoneNumberException("Phone Number array is empty.", 3002);
            }


            foreach ($phoneNumber as $index => $number) {

                $messageToSend = $message;
                if (!empty($replacements)) {
                    $messageToSend = $this->replacements($message, $replacements[$index]);
                }

                $messages[] = [
                    'content'     => $messageToSend,
                    'destination' => $number,
                ];
            }
        }
        

        return Http::withToken($token)
                   ->post("https://rest.smsportal.com/v1/bulkmessages", [
                       'messages' => $messages,
                   ])->json();
    }
}
