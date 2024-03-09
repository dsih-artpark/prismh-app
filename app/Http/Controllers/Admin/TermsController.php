<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Models\Terms;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

use Redirect;

use DataTables;

use Str;

class TermsController extends Controller
{
    public function editterms()
    {
        $terms = Terms::where('status', 1)->first();
        return view('admin.editterms', compact('terms'));
    }
    public function updateterms(Request $request, $id)
    {
        $terms['descp'] = $request->textbox;
        $terms['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
       $upded = DB::table('pwa_terms')->where('id', 1)->update($terms);
        
        if(!empty($upded))
        {
          return redirect()->route('admin.terms.edit')->with ('succes', 'updated successfully');
        }
        else
        {
            return back()->with('error','something are wrong.');
        }
        
        
    }
    
}