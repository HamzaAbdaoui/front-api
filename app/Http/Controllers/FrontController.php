<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('msisdn');
    }

    /**
     * Redirect all requests to the LB
     */
    public function redirectToBack(Request $request, $route) {
        $lbHost = Env('LB_BE_HOST');
        $msisdn = $request->header('x-wassup-msisdn');
        $params = $request->all();

        $guzzleParams = [
            'headers' => [
                'x-wassup-msisdn' => $msisdn
            ]
        ];

        $contentType = $request->header('content-type');
        if ($contentType == 'application/x-www-form-urlencoded' || $contentType == 'application/json')
            $guzzleParams['form_params'] = $params;
        elseif(preg_match('/multipart/', $contentType)){
            $multipart = [];
            foreach ($params as $name => $value) {
                $multipart[] = [
                    'name' => $name,
                    'contents' => $value
                ];
            }
            $guzzleParams['multipart'] = $multipart;
        }

        $client = new Client();
        $res = $client->request($request->method(), $lbHost.$route,
            $guzzleParams
        );

        return $res;
    }
}
