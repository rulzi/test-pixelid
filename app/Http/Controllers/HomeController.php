<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tweet;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$tweets = Tweet::with('user')->get();

    	$data = ['tweets' => $tweets];

        return view('home', $data);
    }
}
