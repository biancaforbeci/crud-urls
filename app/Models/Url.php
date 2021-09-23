<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
  use HasFactory;

  protected $fillable = ['link','description', 'status_code', 'response_http', 'user_id'];

  protected $casts = ['response_http' => 'array'];

  public function user() {
      return $this->belongsTo('App\Models\User');
  }
}
