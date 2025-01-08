<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class APIController extends Controller
{
    /*
     *   Params: url
     *
     */
    public function callApi(Request $request)
    {
        $api_url = $request->input('api'); // Use input() for better clarity.

        // Ensure you have a valid internal API key.
        $internal_api_key = config('app.internal-api-key');
        if (!$internal_api_key) {
            return response()->json(['error' => 'Internal API key not configured.'], 500);
        }

        // Initialize Guzzle Client
        $client = new Client();


        try {
            // Perform the API call
            $response = $client->get($api_url, [
                'headers' => [
                    'x-auth-api-key' => $internal_api_key,
                ]
            ]);

            // Decode JSON response if applicable
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Return the response to the client
            return response()->json([
                'status' => $response->getStatusCode(),
                'data' => $responseBody,
            ]);

        } catch (RequestException $e) {
            // Handle errors gracefully
            return response()->json([
                'error' => 'Failed to call API.',
                'message' => $e->getMessage(),
                'details' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ], 500);
        }
    }
}
