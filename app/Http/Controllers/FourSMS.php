<?php

namespace App\Http\Controllers;

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

class FourSMS extends Controller
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
                'sender' => 'SENDER',
                'route' => 'default',
                'authkey' => 'YOUR_AUTH_KEY',
            ],
        ]);

        return $response->getBody()->getContents();
    }
    
}