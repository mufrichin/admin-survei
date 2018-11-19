<?php

namespace App\Http\Middleware;

use Closure;
use Saml2;

class SamlAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd(session("tipe"));
        if(!is_null(session("tipe"))){
            return $next($request);
        }else{
            return Saml2::login();
        }
    }
}
