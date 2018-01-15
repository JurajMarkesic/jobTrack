<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class JoobleApiController extends Controller
{
    public function getListings(Request $request)
    {
        $this->validate($request, [
            'keywords' => 'required|max:60',
            'location' => 'nullable|max:60'
        ]);

        $keywords = $request->input('keywords');
        $location = $request->input('location');

        $url = 'https://hr.jooble.org/api/' . config('app.jooble_key');  //API access url

        $client = new Client(); //Guzzle Client

        $result = $client->post($url,
                                    ['headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                                     'json' => ["keywords" => "$keywords",
                                                "location" => "$location"
                                               ]
                                     ]
        );


        $responseBody = json_decode($result->getBody());

        $listings = $responseBody->jobs;

        return response()->json([
            'listings' => $listings,
            'msg' => 'Listings fetched successfully.'
        ]);




    }


}
