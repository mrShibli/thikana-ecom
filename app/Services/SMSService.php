<?php

// app/Services/SMSService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    protected $url = "http://bulksmsbd.net/api/smsapi";
    protected $api_key = "kEgMDDr8FmA5QLv5IyHD";
    protected $senderid = "Thikana";

    public function sendSMS($number, $message)
    {
        $data = [
            "api_key" => $this->api_key,
            "senderid" => $this->senderid,
            "number" => $number,
            "message" => $message,
        ];

        $response = Http::asForm()->post($this->url, $data);
        return $response->body();
    }
}
