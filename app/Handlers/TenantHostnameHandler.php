<?php

namespace App\Handlers;

use Tenancy\Hooks\Hostname\Contracts\HostnameHandler;
use Tenancy\Tenant\Events\Event;
use Illuminate\Support\Facades\Mail;

class TenantHostnameHandler implements HostnameHandler
{
    public function handle(Event $event): void
    {
        if (!$this->hasValidDomains($event->tenant)) {
            // Mail::to($event->tenant->email)->send(new DomainsNotValid($event->tenant->getHostnames()));
        }
    }
}
