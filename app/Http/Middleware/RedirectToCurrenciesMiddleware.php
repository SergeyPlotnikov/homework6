<?php

namespace App\Http\Middleware;


class RedirectToCurrenciesMiddleware
{
    public function handle()
    {
        return redirect('/admin/currencies');
    }
}