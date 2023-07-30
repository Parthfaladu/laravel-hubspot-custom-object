<?php

namespace App\Listeners;

use App\Events\HubspotCustomObjectEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\HubspotService;

class HubspotCustomObjectListner
{
    /**
     * Create the event listener.
     *
     * This class listens for the HubspotCustomObjectEvent and handles it by storing the data
     * in HubSpot's custom object using the HubspotService.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * This method is automatically executed when the HubspotCustomObjectEvent is triggered.
     * It tries to store the data in HubSpot's custom object using the HubspotService's storeCustomObject method.
     * If an exception occurs during the storage process, it logs an error.
     *
     * @param HubspotCustomObjectEvent $event The event containing the data to be stored in HubSpot.
     * @return void
     */
    public function handle(HubspotCustomObjectEvent $event): void
    {
        try {
            // Call the storeCustomObject method of the HubspotService to store the data in HubSpot.
            (new HubspotService)->storeCustomObject($event->objectType, $event->data);
        } catch(Exception $exception) {
            // If an exception occurs, log an error indicating the failure of the custom object operation.
            Log::error('Error on '.$event->objectType.' custom object operation');
        }
    }
}
