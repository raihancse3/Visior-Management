<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Role\Helpers;
use Auth;
class CheckPermission
{
    protected $helper;
    public function __construct(Helpers $helper)
    {
        $this->helper = $helper;
    }

    public function handle($request, Closure $next, $permissions)
    {
        $id = Auth::user()->id;
        
        if($this->helper->has_permission($id, $permissions)){
            return $next($request);
        }else{
            abort(403);
        }
        
    }
}
