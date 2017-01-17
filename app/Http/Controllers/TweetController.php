<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tweet;
use Auth;

class TweetController extends Controller
{
    public function save(Request $request)
    {
    	$tweet = New Tweet();

    	$tweet->user_id = Auth::user()->id;
    	$tweet->tweet = $request->status;

    	$tweet->save();

    	return redirect(route('home'));
    }
}
