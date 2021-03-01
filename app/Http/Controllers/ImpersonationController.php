<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Scopes\TenantScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function leave(Request $request)
    {
        if (!auth()->user()->hasRole(3)) {
            abort(403);
        }
        if (!session()->has('impersonate')) {
            abort(403);
        }
        $originalUserId = session('impersonate');
        //Auth::guard('sanctum')->loginUsingId($originalUserId );
        Auth::guard('web')->login(User::withoutGlobalScope(TenantScope::class)->find($originalUserId));
        //Auth::guard('web')->login(User::withoutGlobalScope(TenantScope::class)->find($originalUserId));
        session()->forget('impersonate');
        return redirect('acl');
    }
}
