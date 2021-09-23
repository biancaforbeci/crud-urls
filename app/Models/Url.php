<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
  use HasFactory;

  protected $fillable = ['link','description', 'user_id'];

  public function user() {
      return $this->belongsTo('App\Models\User');
  }

  public function responseUrls() {
      return $this->hasMany('App\Models\ResponseUrl');
  }
}
