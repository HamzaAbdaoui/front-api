<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function redirectToBack(Request $request, $route) {
   	$response = Http::get('http://10.25.17.89/stores');
	return $response;

 }
}
