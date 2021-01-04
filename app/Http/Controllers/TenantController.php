<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Brand;
use App\Rent;
use App\RentDetail;
use App\User;
use App\Commission;
use App\CommissionDetail;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function index()
    {
      $userid = Auth::user()->id;
      $items = Item::where('tenant_id',$userid)->get();

      return view('tenant.item.list')->with('items', $items);
    }
    public function addItem()
    {
      Session::flash('form-method','add');
      return view('tenant.item.form');
    }
    public function submitItem(Request $r)
    {
      // return $r;

      $item = new Item;
      $item->tenant_id = $r->tenant_id;
      $item->name = $r->name;
      $item->category = $r->category;
      $item->brand = $r->brand;
      $item->rent_price = $r->rent_price;
      $item->bail_price = $r->rent_price;
      $item->description = $r->description;
      $item->stock = 1;
      $item->rented_times = 0;
      $item->rating = 0.0;
      try
      {
          $item->save();
          for ($i=1; $i <=3 ; $i++)
          {
            if($r->hasFile('image-1'))
            {
              $img = $r->file("img_".$i);
              $img->move('images/items',$item->id.'-'.$i.'.'.$img1->getClientOriginalExtension());
            }
          }
          $response = ['err'=>false,'msg'=>$item->name.' has been registered to the store. please wait for our admin to accept your request','redirect'=>"#"];
      }
      catch (\Exception $e)
      {
        $response = ['err'=>true,'msg'=>'item failed to be registered! '.$e->getMessage(),'redirect'=>"#"];
      }
      echo json_encode($response);
    }
    public function commissionRequest()
    {
      $uid = Auth::user()->id;
      $available_commissions = RentDetail::join('items', 'items.id','=','rent_details.item_id')
                                          ->join('rents', 'rents.id','=','rent_details.parent_id')
                                          ->where('rents.returned',true)
                                          ->where('rent_details.commision_status',false)
                                          ->where('items.tenant_id',$uid)
                                          ->select('items.name','items.rent_price','rents.overcharge','rent_details.*')
                                          ->get();

      return view('tenant.commission.form')->with('commissions', $available_commissions);
    }
    public function submitCommissionRequest()
    {
      $uid = Auth::user()->id;
      $data = RentDetail::join('items', 'items.id','=','rent_details.item_id')
                                          ->join('rents', 'rents.id','=','rent_details.parent_id')
                                          ->where('rents.returned',true)
                                          ->where('rent_details.commision_status',false)
                                          ->where('items.tenant_id',$uid)
                                          ->select('items.name','items.rent_price','rents.overcharge','rent_details.*','rent_details.id as rent_detail_id')
                                          ->get();
      $c = new Commission;
      $c->tenant_id = $uid;
      $c->accepted = false;
      $c->overcharge_amount = 0;
      $c->damage_amount = 0;
      $c->request_date = \Carbon\Carbon::now();

      try
      {
          $c->save();
          foreach ($data as $d)
          {
            $base_price = $d->day_count * $d->rent_price;
            $tax = (10/100) * ($base_price + $d->overcharge);
            $subtotal = $base_price - $tax;

            $cd = new CommissionDetail;
            $cd->parent_id = $c->id;
            $cd->rent_detail_id = $d->rent_detail_id;
            $cd->subtotal  = $subtotal;

            $rd = RentDetail::find($d->rent_detail_id);
            $rd->commision_status = true;

            $cd->save();
            $rd->save();
          }
          $response = ['err'=>false,'msg'=>'Commission has been requested. please wait for our admin to accept your request','redirect'=>"#"];
      }
      catch (\Exception $e)
      {
        $response = ['err'=>true,'msg'=>'Commission request failed! '.$e->getMessage(),'redirect'=>route('tenant_index')];
      }
      echo json_encode($response);
    }
    public function commissionDetails($id)
    {
      $commission = Commission::find($id);
      $details = CommissionDetail::where('commission_details.parent_id',$id)
                  ->join('rent_details','rent_details.id','=','commission_details.rent_detail_id')
                  ->join('items','items.id','=','rent_details.item_id')
                  ->get();

      return view('tenant.commission.invoice')
              ->with('data', $commission)
              ->with('details', $details);
    }
    public function showCommissions($id)
    {
      $c = Commission::where('tenant_id',$id)->get();

      return view('tenant.commission.list')
              ->with('commissions', $c);
    }
}
