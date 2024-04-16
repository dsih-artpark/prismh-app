<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Customer;
use Session;
use Auth;
use Redirect;
use Carbon\Carbon;


class QueryController extends Controller
{   
    public function index()
    {
      $queries = [];
      return view('includes.query.index', compact('queries'));
    }
}
