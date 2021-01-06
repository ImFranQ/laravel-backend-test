<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Rules\HeavyPassword;
use Illuminate\Validation\Rule;

class UserValidator
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
        /**
         * User validation rules
         */
        $rules = [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required'],
            'dni' => ['required', 'unique:users'],
            'birthdate' => ['required', 'date_format:Y-m-d'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'email' => ['required', 'email', 'unique:users'],
        ];

        if( $request->method() === 'POST' )
            $rules['password'] = ['required', 'min:8', new HeavyPassword];

        if( $request->method() === 'PUT' )
            $rules['password'] = [
                Rule::requiredIf($request->password !== null), 
                'nullable', 
                'min:8', 
                new HeavyPassword
            ];

        $request->validate($rules); // validate request

        /**
         * if has password will be encrypted
         */
        if( $request->has('password') ) 
            $request->merge(['password' => bcrypt($request->password)]);

        return $next($request);
    }
}
