<?php
declare(strict_types=1);

namespace ScheMeZa\SMSPortal\Tests;

use ScheMeZa\SMSPortal\EmptyPhoneNumberException;
use ScheMeZa\SMSPortal\LimitExceededException;
use ScheMeZa\SMSPortal\ReplacementsException;
use ScheMeZa\SMSPortal\SMSPortal;
use ScheMeZa\SMSPortal\SMSPortalServiceProvider;


use Tests\TestCase;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SMSPortalServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function check_for_exception_if_phonenumber_count_not_equals_replacements_count_if_phone_number_is_array()
    {

        $this->expectException(ReplacementsException::class);

        $phoneNumber = ["0000000000"];
        $message = "testing";
        $replacement = [
            ["key" => "key", "value" => "value"],
            ["key" => "key", "value" => "value"]
        ];

        $smsportal = new SMSPortal();
        $smsportal->sendMessage($phoneNumber, $message, $replacement);
    
    }

    /**
     * @test
     */
    public function check_for_exception_if_replacements_given_with_single_string_phonenumber()
    {
        $this->expectException(ReplacementsException::class);

        $phoneNumber = "0000000000";
        $message = "testing";
        $replacement = [
            ["key" => "key", "value" => "value"],
            ["key" => "key", "value" => "value"]
        ];

        $smsportal = new SMSPortal();
        $smsportal->sendMessage($phoneNumber, $message, $replacement);
    
    }


    /**
     * @test
     */
    public function check_for_exception_if_phonenumber_array_larger_than_100_items()
    {
        $this->expectException(LimitExceededException::class);


        $phoneNumber = [];

        for ($x =0; $x < 101; $x++) {
            $phoneNumber[] = "000000".str_pad((string)$x, 4, "0", STR_PAD_LEFT);
        }

        $message = "testing";
 

        $smsportal = new SMSPortal();
        $smsportal->sendMessage($phoneNumber, $message);
    
    }


    /**
     * @test
     */
    public function check_for_exception_if_phonenumber_array_is_empty()
    {
        
        $this->expectException(EmptyPhoneNumberException::class);

        $phoneNumber = [];
        $message = "testing";

        $smsportal = new SMSPortal();
        $smsportal->sendMessage($phoneNumber, $message);
    
    }


    /**
     * @test
     */
    public function check_for_exception_if_phonenumber_string_is_empty()
    {
        
        $this->expectException(EmptyPhoneNumberException::class);

        $phoneNumber = "";
        $message = "testing";

        $smsportal = new SMSPortal();
        $smsportal->sendMessage($phoneNumber, $message);
    
    }



}


