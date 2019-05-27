<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Miss;
use App\Contract;
use Auth;
use App\CreateTbl;
use DB;
use App\Price;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $this->createTbl();
        $user_id=auth()->user()->id;
        $utype=auth()->user()->utype;
        $user=User::find($user_id);
        //get user status
        $status=DB::table('statuses')->where('user_id',$user_id) 
        ->first();
        //dd($status->expire_at);
        //get price list
 
        $price=DB::table('price')->where('country',auth()->user()->ucountry) 
        ->where('name',$utype)->first();

         
        
        //create a tbl with interupt a view, practical but not confirmed
        switch($utype){
            case 'miss':
                return view('dashboard')->with('posts',$user->misss)
                ->with('utype','miss')->with('price',$price)->with('status',$status);
                
            case 'ptmiss':
                return view('dashboard')->with('posts',$user->ptmisss)->with('utype','ptmiss')
                ->with('price',$price)->with('status',$status);
            case 'massage':
                return view('dashboard')->with('posts',$user->massages)->with('utype','massage')
                ->with('price',$price)->with('status',$status);
            case 'contract':
                return view('dashboard')->with('posts',$user->contracts)->with('utype','contract');
            case 'baoyang':
                return view('dashboard')->with('posts',$user->baoyangs);


        }
       
        
    }
    public function createTbl(){ 
        $ucountry=auth()->user()->ucountry;
        //$ucountry=Auth::user()->ucountry;
        $utype=auth()->user()->utype;
        //$utype=Auth::user()->utype;
        $a=new CreateTbl();
        //the way of use model function
        
        switch($utype){
            case 'miss':
                return $a->create_miss_tbl($ucountry);
            case 'massage':
                return $a->create_mass_tbl($ucountry,$utype);
            case 'ptmiss':
                return $a->create_ptmiss_tbl($ucountry);
            case 'baoyang':
                break;
            default:
            # code...
            break;

        }
               
    }
    public function pay(Request $request){
        dd($request->all());
    }
    public function showcard(){
        // Set your secret key: remember to change this to your live secret key in production
          // See your keys here: https://dashboard.stripe.com/account/apikeys
          \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");
  
          $intent = \Stripe\PaymentIntent::create([
          'amount' => 4999,
          'currency' => 'eur',
          ]);
          return view('dashboardInc.card');
  
    }
    /*
    public function charge(Request $request){
        dd($request->input('amount'));

        // Set your secret key: remember to change this to your live secret key in production
      // See your keys here: https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");
      
      // Token is created using Checkout or Elements!
      // Get the payment token ID submitted by the form:
      $token = $_POST['stripeToken'];
      $charge = \Stripe\Charge::create([
          'amount' => $request->input('amount'),
          'currency' => 'eur',
          'description' => 'Example charge',
          'source' => $token,
      ]);
      if($charge->captured==true)
      return "fulfilling the purchase ....";
      }
      *****/
      public function createIntent(Request $request){ 
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");

        \Stripe\PaymentIntent::update(
        'pi_1DRuHnHgsMRlo4MtwuIAUe6u',
        [
            'amount' => 1499,
        ]
        );
    }

    public function updateAmt(Request $request){ 
        //dd($request->all());
        
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");

        \Stripe\PaymentIntent::update(
        'pi_1DRuHnHgsMRlo4MtwuIAUe6u',
        [
            'amount' => $request->amt,
        ]
        );
    }

    public function charge(Request $request){ 
         
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_f2eiG8tsfC8Y8CYcYNevtt3f00MXDBLS00");

        $intent = \Stripe\PaymentIntent::retrieve("pi_Aabcxyz01aDfoo");
        $charges = $intent->charges->data;
    }
    public function ajtest(Request $request){ 
        $data=$request->amt;
        return $data;
    }
}

//thinking and check: if not using facade/auth, Auth namespace can't b used, I have 
// to use auth() in app/user, does it mean facade could be avoid in this case