<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (strpos(url()->current(), '/api/') !== false) {
            return route('tokenexpired');
        }
        else {
            return route('login');
        }

        // if( request()->wantsJson() )
        // {
        //     return route('tokeexpired');
        // }
        // else {
        //     return route('login');
        // }
        // if (! $request->expectsJson()) {
        //     return route('tokeexpired');
        // }
    }
}
