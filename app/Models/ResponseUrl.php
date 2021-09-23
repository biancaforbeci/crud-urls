<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseUrl extends Model
{
    use HasFactory;

    protected $table = 'response_urls';

    protected $fillable = ['status_code','response_http', 'html', 'url_id'];

    public function url() {
        return $this->belongsTo('App\Models\Url');
    }
}
