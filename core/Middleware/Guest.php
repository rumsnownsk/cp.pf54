<?php

namespace PHPFrw\Middleware;

class Guest
{
    public function handle(): void
    {
        if (check_auth()){
            response()->redirect(base_url('/'));
        }
    }
}