<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Hubspot\StoreRequest;
use App\Events\HubspotCustomObjectEvent;

class HubspotController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request The incoming request containing the data to be stored in HubSpot.
     * @return bool
     */
    public function __invoke(StoreRequest $request): bool
    {
        // Trigger the custom event to store data in HubSpot's custom object.
        // This method is invoked when a POST request is made to /hubspot/post/store.

        // Extract the 'content' field from the incoming request.
        $content = $request->get('content');

        // Create a new HubspotCustomObjectEvent and pass the data to be stored in the event payload.
        // The 'posts' argument represents the custom object type in HubSpot where the data will be stored.
        event(new HubspotCustomObjectEvent('posts', [
            'content' => $content
        ]));

        return true;
    }
}
