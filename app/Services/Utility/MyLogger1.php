<?php
namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;

class MyLogger1 implements ILogger
{

    public function __construct()
    {}

    public function debug($message)
    {
        Log::debug($message);
    }

    function getLogger()
    {}

    public function warning($message)
    {
        Log::warning($message);
    }

    public function error($message)
    {
        Log::error($message);
    }

    public function info($message)
    {
        Log::info($message);
    }
}

