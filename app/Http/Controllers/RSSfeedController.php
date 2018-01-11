<?php

namespace App\Http\Controllers;

use App\HelperClasses\TempListing;
use Illuminate\Http\Request;

class RSSfeedController extends Controller
{
    public function getListings(Request $request)
    {
        $this->validate($request, [
            'keywords' => 'required|max:20'
        ]);

        $keywords = $request->input('keywords');

        $rss = simplexml_load_file('https://www.posao.hr/poslovi/izraz/' . $keywords . '/prikaz/rss/',
            'SimpleXMLElement',  LIBXML_NOCDATA);

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





        return response()->json([
            'listings' => $listings
        ]);
    }
}
