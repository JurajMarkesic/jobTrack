<?php

namespace App\Http\Controllers;

use App\HelperClasses\TempListing;
use Illuminate\Http\Request;

class RSSfeedController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|
     * \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function getListings(Request $request)
    {
        $this->validate($request, [
            'keywords' => 'required|max:20'
        ]);

        $keywords = $request->input('keywords');

        try {
            $rss = simplexml_load_file('https://www.posao.hr/poslovi/izraz/' . $keywords . '/prikaz/rss/',
                'SimpleXMLElement', LIBXML_NOCDATA);
        } catch (\Exception $e) {
            return response("No listings for that keyword.", 200);     //triggers if no listings match the query
        }                                                                           // or if something is wrong with the site

        $listings = $this->parseXML($rss);

        return response()->json([
            'listings' => $listings
        ]);
    }


    /**
     * @param $rss
     * @return array
     */

    public function parseXML($rss)                                          //parses the xml and makes an arry of TempListings
    {
        $listings = [];

        foreach ($rss->channel->item as $item) {
            $listing = new TempListing();

            $listing->title = (String)$item->title;
            $listing->link = (String)$item->link;

            $subStr1 = substr($item->description, 12 );
            $arr = explode("<", $subStr1, 3);

            $listing->location = substr($arr[1], 17);

            $listing->company = $arr[0];

            array_push($listings, $listing);
        }

        return $listings;
    }
}
