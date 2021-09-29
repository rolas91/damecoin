<?php

namespace App\Http\Middleware;


use Closure;

class LangMiddleware
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
        if (session("lang")) {
            $lang = session("lang");
           // session(['lang' => $lang]);
        } else {
            // check browser lang - https://learninglaravel.net/detect-and-change-language-on-the-fly-with-laravel
            $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
 
            if ($lang != 'es' && $lang != 'en') {
                $lang = 'es';
            }
        }
        \App::setLocale($lang);
        

       // Route::get(__('route.index',["cripto"=>'{crypto}',"currency"=>'{divisa}']), 'IndexController@indexx');
        //return "swss";
        //return redirect('/login');
       // return redirect(__('route.index',["cripto"=>'{crypto}',"currency"=>'{divisa}']));
        return $next($request);
    }
}
