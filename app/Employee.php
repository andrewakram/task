<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'e_id';
    protected $table = 'employees';
    protected $fillable = [
        'e_fname',
        'e_lname',
        'e_email',
        'e_phone',
        ];
    protected $date = ['delete_at'];
    protected $hidden = ["deleted_at"];
}
