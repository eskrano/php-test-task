<?php

namespace App;

interface TrackerInterface
{
    public function track(string $url, string $ip, string $userAgent): void;
}