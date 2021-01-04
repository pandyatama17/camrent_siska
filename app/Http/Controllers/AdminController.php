<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Rent;
use App\RentDetail;
use App\User;
use App\Item;
use App\Commission;
use App\CommissionDetail;
use DB;
use Session;

class AdminController extends Controller
{
    public function dashboard()
    {
    	 return view('admin.dashboard');
    }
		public function showOrders()
		{
			$rents = Rent::select(
					'rents.*',
					DB::raw('(select start_date from rent_details where parent_id  =   rents.id  order by id asc limit 1) as start_date'),
					DB::raw('(select end_date from rent_details where parent_id  =   rents.id  order by id desc limit 1) as end_date')
					)
					->orderBy('start_date','asc')
				->get();

			$method = "All";

			return view('admin.rents')->with('rents', $rents)->with('method',$method);
		}
		public function showUnacceptedOrders()
		{
			$rents = Rent::where('picked_up',0)
					->select(
							'rents.*',
							DB::raw('(select start_date from rent_details where parent_id  =   rents.id  order by id asc limit 1) as start_date'),
							DB::raw('(select end_date from rent_details where parent_id  =   rents.id  order by id desc limit 1) as end_date')
							)
					->orderBy('start_date','asc')
				->get();
			$method = "Unnacepted";
			return view('admin.rents')->with('rents', $rents)->with('method',$method);
		}
		public function showAcceptedOrders()
		{
			$rents = Rent::where('picked_up',1)
					->where('returned', 0)
					->select(
							'rents.*',
							DB::raw('(select start_date from rent_details where parent_id  =   rents.id  order by id asc limit 1) as start_date'),
							DB::raw('(select end_date from rent_details where parent_id  =   rents.id  order by id desc limit 1) as end_date')
							)
					->orderBy('start_date','asc')
				->get();
			$method = "Accepted";
			return view('admin.rents')->with('rents', $rents)->with('method',$method);
		}
		public function showFinishedOrders()
		{
			$rents = Rent::where('picked_up',1)
					->where('returned', 1)
					->select(
							'rents.*',
							DB::raw('(select start_date from rent_details where parent_id  =   rents.id  order by id asc limit 1) as start_date'),
							DB::raw('(select end_date from rent_details where parent_id  =   rents.id  order by id desc limit 1) as end_date')
							)
					->orderBy('start_date','asc')
				->get();
			$method = "Finished";
			return view('admin.rents')->with('rents', $rents)->with('method',$method);
		}

		public function startOrder($id)
		{
			$r = Rent::find($id);

			if (!$r) {
				$arr = ['error'=>true,'message'=>'order not found','redirect'=>'#'];
			}
			else {
				$r->picked_up = true;
				try {
					$r->save();
					$arr = ['error'=>false,'message'=>'order '.$r->code.' is started','redirect'=>'#'];
				} catch (\Exception $e) {
					$arr = ['error'=>true,'message'=>$e->getMessage(),'redirect'=>'#'];
				}
			}
			echo json_encode($arr);
		}

		public function getOrder($id)
		{
			$r = Rent::find($id);

			if (!$r) {
				$arr = ['error'=>true,'message'=>'order not found','redirect'=>'#'];
			}
			else
			{
				$c = User::find($r->user_id);
				$rd = RentDetail::where('parent_id',$id)
							->leftJoin('items', 'rent_details.item_id','=','items.id')
							->select('rent_details.*','items.name as item', 'items.rent_price as price', 'items.bail_price as damage_fee')
							->get();
				echo json_encode(['rent'=>$r,'details'=>$rd,'client'=>$c]);
			}
		}
		public function finishOrder(Request $r)
		{
			$rent = Rent::find($r->id);
      // return $r;
			if (!$rent) {
				$arr = ['error'=>true,'message'=>'order not found','redirect'=>'#'];
			}
			else
			{
				$rent->returned = true;
        $rent->overcharge = $r->overcharge;
        $rent->total = $r->total;
        $rent->paid = true;
        $damage_fee = 0;
        for ($i=0; $i < $r->items; $i++)
        {
          $rd = RentDetail::find($r->input('details_'.$i));
          $item = Item::find($rd->item_id);
          if ($r->input('damaged_'.$i)) {
            $rd->damaged = true;
            $damage_fee += $r->input('damaged_'.$i);
          }
          else {
            // $item->stock += 1;
            $item->available = true;
          }
          try {
            $item->save();
  					$rd->save();
  					$err = false;
  				} catch (\Exception $e) {
  					$err = true;
            $msg  = 'details_'.$i.' trace : '.$e->getMessage();
  				}
        }
        $rent->damage_fee = $damage_fee;
				try {
					$rent->save();
          $err = false;
				} catch (\Exception $e) {
          $err = true;
          $msg  = 'rent. trace : '.$e->getMessage();
				}
        if ($err == true) {
          $arr = ['err'=>true,'msg'=>$msg,'redirect'=>'#'];
        } else {
          $arr = ['err'=>false,'msg'=>'order '.$rent->code.' finished','redirect'=>'#'];
        }
			}
			echo json_encode($arr);
		}

    public function showItems()
    {
      $it = Item::all();

      return view('admin.items')->with('items',$it)->with('action', 'show');
    }
    public function showUnnaceptedItems()
    {
      $it = Item::where('accepted',false)->get();

      return view('admin.items')->with('items',$it)->with('action', 'register_request');
    }
    public function showUnretractedItems()
    {
      $it = Item::where('retract_request',true)->get();

      return view('admin.items')->with('items',$it)->with('action', 'retract_request');
    }
    public function addItem(Request $r)
    {
      // $id = 20;
      // return $r;
      $it = new Item;
      $it->name = $r->name;
      $it->brand = $r->brand;
      $it->category = $r->category;
      $it->rent_price = $r->rent_price;
      $it->bail_price = $r->bail_price;
      $it->stock = $r->stock;
      $it->description = $r->description;
      $it->rented_times = 0;
      $it->rating = '0.0';

      try {
        $it->save();
        if($r->hasFile('image-1'))
        {
          $img1 = $r->file('image-1');
          $img1->move('images/items',$it->id.'-1.'.$img1->getClientOriginalExtension());
        }
        if($r->hasFile('image-2'))
        {
          $img2 = $r->file('image-2');
          $img2->move('images/items',$it->id.'-2.'.$img2->getClientOriginalExtension());
        }
        if($r->hasFile('image-3'))
        {
          $img3 = $r->file('image-3');
          $img3->move('images/items',$it->id.'-3.'.$img3->getClientOriginalExtension());
        }
        $arr = ['err'=>false,'msg'=>$r->name.' saved!'];
      } catch (\Exception $e) {
        $arr = ['err'=>true,'msg'=>'item not saved! error: '.$e->getMessage()];
      }
      echo json_encode($arr);
    }
    public function showClients()
    {
      $c = User::where('isadmin',false)->get();

      return view('admin.clients')->with('clients', $c);
    }
    public function getClientRents($id)
    {
      $r = Rent::where('user_id',$id)->get();

      return view('admin.clienthistory')->with('rents', $r);
    }
    public function acceptLeaseRequest($id)
    {
      $item = Item::find($id);

      $item->accepted = true;
      $item->available = true;
      $item->accept_date = \Carbon\Carbon::now();

      try {
        $item->save();
        Session::flash('message',$item->name.' accepted and added to stock!');
        Session::flash('message-type','success');
        // $arr = ['err'=>false,'msg'=>$item->name.' accepted and added to stock!'];
      } catch (\Exception $e) {
        Session::flash('message','item not saved!');
        Session::flash('message-type','error');
        // $arr = ['err'=>true,'msg'=>'item not saved! error: '.$e->getMessage()];
      }
      return redirect()->route('show_items');
    }
    public function commissionRequest()
    {
      $c = Commission::where('accepted',false)->get();

      return view('tenant.commission.list')
              ->with('commissions', $c);
    }
    public function showCommissions()
    {
      $c = Commission::all();

      return view('tenant.commission.list')
              ->with('commissions', $c);
    }
    public function acceptCommission($id)
    {
      $c = Commission::find($id);

      $c->accepted = true;
      $c->accept_date = \Carbon\Carbon::now();

      try
      {
          $c->save();
          Session::flash('message','Commission accepted sucessfully!');
          Session::flash('message-type','success');
      }
      catch (\Exception $e)
      {
        Session::flash('message','Failed to accept commission!');
        Session::flash('message-type','error');
      }

      return redirect()->route('show_commissions');
    }
}
