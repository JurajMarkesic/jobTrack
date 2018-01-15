<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Mockery\Exception;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $listings = $user->listings;

        foreach($listings as $listing) {
            $listing->contact;
        }

        return response()->json([
            'listings' => $listings
        ]);
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Checks if user has already stored this listing
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function check(Request $request)
    {
        $listingTitle = $request->input('listingTitle');
        $listingCompany = $request->input('listingCompany');

        $user = Auth::user();

        $isSaved = false;

        foreach($user->listings as $userListing) {
            if(($userListing->title == $listingTitle) && ($userListing->company_name == $listingCompany)) {
                $isSaved = true;
            }
        }
        return response()->json([
            'isSaved' => $isSaved
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listing = new Listing();
        $contact = new Contact();

        $this->validate($request,[
            'company_name' => 'bail|required|string|max:100',
            'link' => 'bail|required|url',
            'title' => 'bail|required|string|max:100',
            'location' => 'bail|required|string|max:100',
            'rating' => 'nullable|between:1,10',
            'status' =>  'nullable|string',
            'applied_on' => 'nullable|date',
            'contact_name' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email'
        ]);

        $listing->owner_id = Auth::id();
        $listing->company_name = $request->input('company_name');
        $listing->link = $request->input('link');
        $listing->title = $request->input('title');
        $listing->location = $request->input('location');


        if($request->has('rating')){
            $listing->rating = $request->input('rating');
        }
        if($request->has('status')){
            $listing->status = $request->input('status');
        }

        $listing->save();



        $contact->owner_id = $listing->id;

        if($request->has('applied_on')){
            $contact->applied_on = $request->input('applied_on');     //contact info in not required for a listing to be saved
        }
        if($request->has('contact_name')){
            $contact->contact_name = $request->input('contact_name');
        }
        if($request->has('contact_email')){
            $contact->contact_email = $request->input('contact_email');
        }

        $contact->save();


        return response("Listing stored", 200);

    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Listing  $listing
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Listing $listing)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Listing  $listing
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Listing $listing)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $this->validate($request,[
            'company_name' => 'bail|required|string|max:100',
            'link' => 'bail|required|url',
            'title' => 'bail|required|string|max:100',
            'location' => 'bail|required|string|max:100',
            'rating' => 'nullable|integer|between:1,10',
            'status' =>  'nullable|string',
            'applied_on' => 'nullable|date',
            'contact_name' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email'
        ]);

        $listing->company_name = $request->input('company_name');
        $listing->link = $request->input('link');
        $listing->title = $request->input('title');
        $listing->location = $request->input('location');


        if($request->has('rating')){
            $listing->rating = $request->input('rating');
        }
        if($request->has('status')){
            $listing->status = $request->input('status');
        }

        $listing->update();



        $contact = $listing->contact;

        if($request->has('applied_on')){
            $contact->applied_on = $request->input('applied_on');
        }
        if($request->has('contact_name')){
            $contact->contact_name = $request->input('contact_name');
        }
        if($request->has('contact_email')){
            $contact->contact_email = $request->input('contact_email');
        }

        $contact->update();

        return response('Listing edited', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        try {
            $listing->delete();
        } catch(\Exception $e) {
            report($e);
            return response("Listing does not exist", 404);
        }


        return response("Listing destroyed", 200);
    }
}
