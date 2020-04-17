<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;
use App\Rent;
use App\RentDetail;
use App\User;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function main()
    {
      $new = Item::where('category' ,'<', 3)->orderBy('id','desc')->take(8)->get();
      $new_dslr = Item::where('category',1)->orderBy('id','desc')->take(6)->get();
      $new_mirr = Item::where('category',2)->orderBy('id','desc')->take(6)->get();
      $new_lens = Item::where('category',3)->orderBy('id','desc')->take(6)->get();
      $top = Item::orderBy('rating','desc')->take(4)->get();
      $td = Item::where('category',1)->orderBy('rating','desc')->take(4)->get();
      $tm = Item::where('category',2)->orderBy('rating','desc')->take(4)->get();
      $to = Item::where('category','!=',1)->where('category','!=',2)->orderBy('rating','desc')->take(4)->get();

      Session::flash('currentPage','Home');
      Session::flash('crumbSteps',['home'=>'/']);
      return view('client.main')
            ->with('new', $new)
            ->with('new_dslr', $new_dslr)
            ->with('new_mirr', $new_mirr)
            ->with('new_lens', $new_lens)
            ->with('top', $top)
            ->with('top_dslr', $td)
            ->with('top_mirr', $tm)
            ->with('top_others', $to);
    }
    public function quickView($id)
    {
      $item = Item::find($id);

      return view('client.quickview-details',['data'=>$item]);
    }

    public function showItems()
    {
      $items = Item::all();
      Session::flash('currentPage','Store');
      Session::flash('crumbSteps',['home'=>'/','store'=>'/store']);
      $ts = Item::orderBy('rented_times','desc')->take(3)->get();
      return view('client.items')
      ->with('items', $items)
      ->with('top_selling', $ts);
    }

    public function showItem($id)
    {
      $item = Item::find($id);
      $rel = Item::where('category',$item->category)->take(4)->get();
      Session::flash('currentPage','Product');
      Session::flash('crumbSteps',['home'=>'/','store'=>'/store', $item->name => 'product/'.$item->id]);

      return view('client.item')
      ->with('item', $item)
      ->with('related', $rel);
    }

    public function addToCart(Request $r)
    {
      $item = Item::find($r->id);

      $cart = session()->get('cart');
      // if cart is empty then this the first product
      if(!$cart)
      {
        $cart =
        [
          $r->id =>
          [
            'id'=>$item->id,
            "name" => $item->name,
            "plan" => $r->plan,
            "start_date" => $r->start_date,
            "end_date" => $r->end_date,
            "price" => $item->rent_price,
          ]
        ];
        try
        {
          session()->put('cart', $cart);
          $arr = array('err'=>false,'msg'=>$item->name.' added to cart!','redirect'=>$item->id);
  				echo json_encode($arr);
        }
        catch (\Exception $e)
        {
          $arr = array('err'=>true,'msg'=>'Invalid Proccess.'.json_encode($e->getMessage()));
  				echo json_encode($arr);
        }
    }
    else
    {
      $cart[$r->id] =
      [
        'id'=>$item->id,
        "name" => $item->name,
        "plan" => $r->plan,
        "start_date" => $r->start_date,
        "end_date" => $r->end_date,
        "price" => $item->rent_price,
      ];
      try
      {
        session()->put('cart', $cart);
        $arr = array('err'=>false,'msg'=>$item->name.' added to cart!','redirect'=>$item->id);
        echo json_encode($arr);
      }
      catch (\Exception $e)
      {
        $arr = array('err'=>true,'msg'=>'Invalid Proccess.'.json_encode($e->getMessage()));
        echo json_encode($arr);
      }
    }
    // if item not exist in cart then add to cart with quantity = 1
  }
  public function reloadCart()
  {
    return view('client.cart-dropdown');
  }
  public function removeFromCart($id)
  {
      if($id)
      {
          $name = Item::where('id',$id)->pluck('name')['0'];
          $cart = session()->get('cart');
          if(isset($cart[$id]))
          {
              unset($cart[$id]);
              try
              {
                session()->put('cart', $cart);
                $arr = array('err'=>false,'msg'=>$name.' removed from cart');
              }
              catch (\Exception $e)
              {
                $arr = array('err'=>true,'msg'=>'Invalid Proccess.'.json_encode($e->getMessage()));
              }
          }
          if (null == session('cart'))
          {
            session()->forget('cart');
          }
          echo json_encode($arr);
      }
  }
  public function checkout()
  {
    Session::flash('currentPage','Checkout');
    Session::flash('crumbSteps',['home'=>'/','cart'=>'#', 'checkout' => 'checkout/']);

    return view('client.checkout');
  }

  public function rent()
  {
    $this->middleware('user');

    $request = request();

    $assurance = 0;
    $subtotal = 0;
    foreach (Session::get('cart') as $cart)
    {
      $assurance += Item::find($cart['id'])->pluck('bail_price')[0];
      $subtotal += $cart['plan']*$cart['price'];
    }

    $r = new Rent;
    $r->code = strtoupper(Str::random(12));
    $r->user_id = Auth::user()->id;
    $r->subtotal = $subtotal;
    $r->assurance = $assurance;
    $r->total = $subtotal + $assurance;
    $r->notes = $request['order_notes'];

    try
    {
      $r->save();

      $date = "";
      foreach (Session::get('cart') as $cart)
      {
        $start_date = \Carbon\Carbon::parse($cart['start_date'])->format('Y-m-d');
        $end_date = \Carbon\Carbon::parse($cart['end_date'])->format('Y-m-d');

        $date .= "-------<br> start:".$start_date.'<br>end:'.$end_date.'<br>--------------';
        RentDetail::create([
            'parent_id' => $r->id,
            'item_id' => $cart['id'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'day_count' => $cart['plan'],
        ]);
        // proses ngurangin stok
        $it = Item::find($cart['id']);
        $it->stock = (int)$it->stock - 1;
        $it->save();
      }
      //hapus session cart
      Session::forget('cart');

      // return message success
      $arr = array('err'=>false,'msg'=>'Order #'.$r->code.' Created!','redirect'=>$r->code);
      echo json_encode($arr);
    }
    catch (\Exception $e)
    {
      // return message failed
      $arr = array('err'=>true,'msg'=>'Invalid Proccess.'.$e->getMessage(),'redirect'=>"#");
      echo json_encode($arr);
    }
  }
  public function invoice($code)
  {
      $rent = Rent::where('code',$code)->first();
      $user = User::find($rent->user_id);
      $details = RentDetail::where('parent_id',$rent->id)->get();
      Session::flash('currentPage','Product');
      Session::flash('crumbSteps',['home'=>'/','rent'=>'#', $code => 'invoice/'.$code]);

      return view('client.invoice')->with('rent', $rent)->with('user', $user)->with('details', $details);
  }
}
