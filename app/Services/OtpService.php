<?php
namespace App\Services;

class OtpService
{
    public static function generateOtp()
    {
        return random_int(100000, 999999);
    }
}
