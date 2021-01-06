<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmailValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'email' => ['email', 'required'],
            'body' => ['required'],
            'subject' => ['required']
        ]);

        return $next($request);
    }
}
