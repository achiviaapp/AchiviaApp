<?php

namespace App\Listeners;

use App\Events\ClientDetailCreatedEvent;

use Carbon\Carbon;
use App\Services\AutoAssignService;


class AssignSaleManToClientAutoListener
{
    private $autoAssign;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AutoAssignService $autoAssign)
    {
        $this->autoAssign = $autoAssign;
    }


    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle(ClientDetailCreatedEvent $event)
    {
//        $from = Carbon::parse('today 7am')->format('Y-m-d H:i:s');
//        $to = Carbon::parse('today 7pm')->format('Y-m-d H:i:s');
//        $now = Carbon::now()->format('Y-m-d H:i:s');
//        if ($now < $from && $now > $to) {
//            return;
//        }
        $client = $event->user;

        $this->autoAssign->autoAssign($client);
    }

}