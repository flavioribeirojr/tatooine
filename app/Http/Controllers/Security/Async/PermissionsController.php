<?php

namespace App\Http\Controllers\Security\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Security\Security as SecurityService;

class PermissionsController extends Controller
{
    protected $securityService;

    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
    }
    
    public function checkPermission(Request $request)
    {
        $user = \Auth::user();
        $action = $request->get('action');
        
        $hasPermission = $this->securityService->checkUserPermission($user, $action);
        
        return response(['allow' => 1], 200);
    }
}