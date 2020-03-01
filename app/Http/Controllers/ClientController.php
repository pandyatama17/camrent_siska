<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;

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
      $ts = Item::orderBy('rented_times','desc')->take(3)->get();
      return view('client.items')
      ->with('items', $items)
      ->with('top_selling', $ts);
    }

    public function showItem($id)
    {
      $item = Item::find($id);
      $rel = Item::where('category',$item->category)->take(4)->get();

      return view('client.item')
      ->with('item', $item)
      ->with('related', $rel);
    }
}
