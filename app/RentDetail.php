<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentDetail extends Model
{
    protected $table = 'rent_details';

    protected $fillable =[
      'parent_id','item_id','start_date','end_date','day_count','overdue','damaged','status'
    ];
}
