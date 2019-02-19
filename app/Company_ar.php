<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company_ar extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'c_id';
    protected $table = 'companies_ar';
    protected $fillable = ['c_name','c_logo','c_email','c_website'];
    protected $date = ['delete_at'];
    protected $hidden = ["deleted_at"];
}
