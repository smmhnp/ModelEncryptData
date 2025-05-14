<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptUserData
{
    public function handle(Request $request, Closure $next)
    {
        $fieldsToEncrypt = ['firstname', 'lastname', 'nickname', 'email'];

        foreach ($fieldsToEncrypt as $field) {
            if ($request->has($field)) {
                $request->merge([
                    $field => Crypt::encryptString($request->input($field))
                ]);
            }
        }

        return $next($request);
    }
}
