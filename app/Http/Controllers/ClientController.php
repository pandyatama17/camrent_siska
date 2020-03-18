<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;
use Session;

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

}
