<?php

    namespace App\Http\Middleware;

    use Closure;
    use Auth;
    use Illuminate\Foundation\Auth\ThrottlesLogins;
    use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

    class AdminAuth{
        
        public function handle($request, Closure $next){
            if(Auth::check()){
                return redirect(sprintf("%s/%s",ADMIN_FOLDER,'dashboard'));
            }else{
                return redirect(sprintf("%s/%s",ADMIN_FOLDER,'login'));
            }

            return $next($request);
        }

        protected function validator(array $data){
            $validator = Validator::make($data, [
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
            ]);
            
            return $validator;
        }
    }
