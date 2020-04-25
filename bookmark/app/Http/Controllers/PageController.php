<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * GET /
     */
    public function welcome(Request $request)
    {
        //Using the global 'session' helper, we cn extract our data that was
        //passed from 'BookController@search' as part of the redirect
        $searchTerms = session('searchTerms', null);
        $searchType = session('searchType', null);
        $searchResults = session('searchResults', null);

        //get user data
        //$user = Auth::user();
        //or we can inject the welcome function with the request object by putting 'Request $request' as the parameter and get user data this way
        $user = $request->user();


        # Return our welcome page
        # If there is data stored in the session as the results of doing a search
        # that data will be extracted from the session and passed to the view
        # to display the results
        return view('pages.welcome')->with([
            //if we cannot get the $user->name then set it to null
            //null coalesing operator
            'userName' => $user->name ?? null,
            'searchTerms' => session('searchTerms', null),
            'searchType' => session('searchType', null),
            'searchResults' => session('searchResults', null)
        ]);
    }

    /**
     * GET /support
     */
    public function support()
    {
        return view('pages.support');
    }
}
