<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.home.index', get_defined_vars());
    }


    public function dashboard(){
        return view('frontend.dashboard.index', get_defined_vars());
    }


    public function redirectToUrlOrigin($generated_url){
        $urlData = Url::whereGeneratedUrl($generated_url)->first();

        if(empty($urlData)){
            return redirect(route('home'))->with([
                'warning' => 'Requested Invalid Url!'
            ]);
        }

        $urlData->visit_count += 1;
        $urlData->save();

        $externalUrl = $urlData->original_url;
        return Redirect::away($externalUrl);
    }
}
