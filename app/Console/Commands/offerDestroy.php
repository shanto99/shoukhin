<?php

namespace App\Console\Commands;
use App\Offer;
use App\Grab;
use App\GrabedUser;
use App\Usergrab;
use Carbon\Carbon;
use App\Product;
use App\Usertoken;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class offerDestroy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offer:destroy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will terminate expired offer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $offers = Offer::whereDate('ends_at', '<', Carbon::now())->get();
        foreach($offers as $offer){
            $regular_price = $offer->regular_price;
            Product::where('product_id',$offer->product_id)->update(['discount'=>0, 'price' => $regular_price]);
            Offer::where('product_id',$offer->product_id)->delete();

        }
        $gyds = Grab::whereDate('valid_upto', '<', Carbon::now())->get();
        $users_got_product = array();
        foreach ($gyds as $gyd) {
            foreach (GrabedUser::where('deal_id',$gyd->id)->get() as $grabeduser) {
                array_push($users_got_product, $grabeduser->user_id);
            }
            foreach (Usergrab::whereNotIn('user_id',$users_got_product)->where('grab_id',$gyd->id)->get() as $tokenuser) {
                $usertoken = new Usertoken();
                $usertoken->user_id = $tokenuser->user_id;
                $usertoken->token_number = rand();
                $usertoken->save();

            }
            DB::table('grabs')->where('id',$gyd->id)->delete();
            DB::table('usergrabs')->where('grab_id',$gyd->id)->delete();
            DB::table('product')->where('product_id',$gyd->p_id)->update(['offer'=>1]);

        }
        echo 'done';

    }
}
