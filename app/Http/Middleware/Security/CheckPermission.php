<?php

namespace App\Http\Middleware\Security;

use Closure;
use App\Providers\Security\Security as SecurityService;

class CheckPermission
{
    protected $security;

    public function __construct(SecurityService $security)
    {
        $this->security = $security;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        
        if (!$user) {
            return redirect('/login', 302);
        }

        if (config('app.debug')) {
            return $next($request);
        }

        $url = explode('/', $request->path());
        
        $resource = $url[0];
        $permission = !empty($url[1]) ? $url[1] : 'index';
        
        $userHasPermission = $this->security->checkUserPermission($user, $resource, $permission);
        
        if (!$userHasPermission) {
            return redirect('/login', 302);
        }

        return $next($request);
    }
}
