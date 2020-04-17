<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
  protected $table = 'rents';

  protected $fillable = [
      'code','user_id', 'subtotal', 'assurance', 'total', 'notes', 'overcharge',
      'damage_fee','picked_up','returned','paid'
  ];
}
