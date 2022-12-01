<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Mails\Events\ConfigureMails;

class ConfigureTenantMails
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
     * @param  object  $event
     * @return void
     */
    public function handle(ConfigureMails $event)
    {
        if ($tenant = $event->event->tenant) {
            // Set the "From" Field
            $event->alwaysFrom($tenant->email_from, $tenant->email_name);

            // Optionally add the "ReplyTo" Field
            $event->alwaysReplyTo($tenant->mail_replyto, $tenant->mail_replyto_name);
        }
    }
}
