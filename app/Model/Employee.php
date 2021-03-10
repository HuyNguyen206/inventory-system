<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public function salaries(){
        return $this->hasMany(Salary::class, 'employee_id');
    }
}
