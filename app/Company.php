<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'c_id';
    protected $table = 'companies';
    protected $fillable = ['c_name','c_logo','c_email','c_website'];
    protected $date = ['delete_at'];
    protected $hidden = ["deleted_at"];
}
