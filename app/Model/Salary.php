<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $guarded = [];
    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
