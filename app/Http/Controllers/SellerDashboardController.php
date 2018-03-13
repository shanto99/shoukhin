<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Stripe\Product;

class SellerDashboardController extends Controller
{
    public function  get_chart_data(){
        $product_id_array = array();
        $user_id = Auth::user()->id;
        $products = \App\Product::where('user_id',$user_id)->select('product_id')->get();
        foreach ($products as $product){
            array_push($product_id_array, $product->product_id);
        }



        $chart_data=DB::table('records')->whereIn('product_id',$product_id_array)
            ->select(DB::raw('sum(quantity) as total'),DB::raw('date(created_at) as dates'))
            ->groupBy('dates')
            ->orderBy('dates','desc')
            ->get();
        return Response::json($chart_data);

}
    public function get_desired_chart(){
        $product_id_array = array();
        $user_id = Auth::user()->id;
        $products = \App\Product::where('user_id',$user_id)->select('product_id')->get();
        foreach ($products as $product){
            array_push($product_id_array, $product->product_id);
        }

        $from_date = Input::get('from_date');
        $to_date = Input::get('to_date');
        $chart_data=DB::table('records')->whereIn('product_id',$product_id_array)
            ->select(DB::raw('sum(quantity) as total'),DB::raw('date(created_at) as dates'))->whereBetween('created_at', array($from_date, $to_date))
            ->groupBy('dates')
            ->orderBy('dates','desc')
            ->get();
        return Response::json($chart_data);

    }
}
