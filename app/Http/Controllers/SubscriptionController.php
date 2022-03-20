<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'website_id' => 'required',
            'user_id' => 'required'
        ]);
        
        $website = Website::findOrFail($request->website_id);
        $website->users()->attach($request->user_id);

        return "Success";
    }
}
