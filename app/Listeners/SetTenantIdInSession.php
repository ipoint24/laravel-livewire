<?php

namespace App\Listeners;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Log;

class SetTenantIdInSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if (!empty($event->user->tenant_id)) {
            session()->put('tenant_id', $event->user->tenant_id);
            session()->put('user_id', $event->user->id);
        } else {
            session()->flash('message', 'Kein Mandant');
            // redirect(route('welcome'));
            Auth::logout();
        }
    }
}
