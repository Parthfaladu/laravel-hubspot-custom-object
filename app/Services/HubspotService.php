<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class HubspotService
{
    /**
     * Store custom object data in HubSpot.
     *
     * This method sends a POST request to the HubSpot API to store data in a custom object.
     *
     * @param string $objectType The type of the custom object in HubSpot where the data will be stored.
     * @param array $data The data to be stored in the custom object. It should be an associative array
     *                    containing the custom object's properties and their values.
     * @return string The API response body containing the result of the request.
     *
     * @throws Exception If any error occurs during the API request or if the response indicates an error.
     */
    public function storeCustomObject(string $objectType, array $data)
    {
        $apiUrl = "https://api.hubapi.com/crm/v3/objects/" . $objectType;
        $apiKey = config('services.hubspot.access_token'); // Assuming you have the API key stored in config

        $client = new Client();

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => ["properties" => $data],
            ]);

            $responseBody = $response->getBody()->getContents();
            $decodedResponse = json_decode($responseBody);

            if (!empty($decodedResponse->status) && $decodedResponse->status == 'error') {
                // If the response indicates an error, log the exception.
                logException(new Exception($decodedResponse->message ?? ''));
            }

            // Return the API response body containing the result of the request.
            return $responseBody;
        } catch (GuzzleException $e) {
            // Handle Guzzle related errors and throw a generic Exception with the error message.
            throw new Exception("Guzzle Error: " . $e->getMessage());
        }
    }
}
