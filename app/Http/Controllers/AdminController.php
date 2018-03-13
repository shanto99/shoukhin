<?php

namespace App\Http\Controllers;

use App\Record;
use App\GrabedUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Stripe\Product;
class AdminController extends Controller
{
    public function get_to_admin(){
    	$total_amount = 0;
    	$sold_records = Record::all();
    	foreach ($sold_records as $sold_record) {
    		$total_amount+=$sold_record->quantity * $sold_record->product->price;
    	}
    	return view('admin',compact('total_amount'));
    }
        public function  get_chart_data(){
        	
        $chart_data=DB::table('records')->select(DB::raw('sum(quantity) as total'),DB::raw('date(created_at) as dates'))
            ->groupBy('dates')
            ->orderBy('dates','desc')
            ->get();
        return Response::json($chart_data);
        

}
public function add_delivered(Request $request){
    $rec_id = $request['rec_id'];
    $type = $request['type'];
    if($type == 'buy'){
    $record = Record::find($rec_id);
    $record->is_delivered = 1;
    $record->save();
}else{

    $gyd_record = GrabedUser::find($rec_id);
    $gyd_record->is_delivered = 1;
    $gyd_record->save();
}
return redirect()->back();

}


}
