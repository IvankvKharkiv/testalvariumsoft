<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $appends = array('salary');

    public function getSalaryAttribute(){
        if($this->hourly_wage){
            return 10*$this->hours;
        }else{
            return 10000;
        }
    }

    public function employe(){
        return $this->belongsTo(Employe::class);
    }

}
