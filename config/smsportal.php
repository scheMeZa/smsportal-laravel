<?php

/*
 * SMSPortal API Configuration
 */
return [
    'base_url'  => env('SMSPORTAL_BASE_URL', 'https://rest.smsportal.com/v1'),
    'client_id' => env('SMSPORTAL_CLIENT_ID'),
    'secret'    => env('SMSPORTAL_SECRET'),
];
