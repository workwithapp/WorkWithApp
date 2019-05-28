<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class AuthAPI
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
        if($request->header('token')){
            $checkToken = DB::table('users')->where("token",$request->header('token'))->first();
            if($checkToken && $checkToken->status == 1){
                return $next($request);    
            }else{
                return response(array('error'=>'Invalid Token'), UNAUTHORIZED)->header('Content-Type', 'application/json');
            }
        }else{
                return response(array('error'=>'Token required'), UNAUTHORIZED)->header('Content-Type', 'application/json');
        }
        
    }
}
