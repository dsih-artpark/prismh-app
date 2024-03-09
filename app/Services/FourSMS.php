<?php

namespace App\Services;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use Stevebauman\Location\Facades\Location;

use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use GuzzleHttp\Client;

class FourSMS 
{
      protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function generate(Request $request)
    {
        $response = $this->client->request('POST', 'sms.php', [
            'form_params' => [
                'mobile' => $mobile,
                'message' => $message,
                'sender' => 'VBFSMS',
                'route' => 'default',
                'authkey' => 'Ab03e3e01101171ea663244197610958f',
            ],
        ]);

        return $response->getBody()->getContents();
    }
    
}