<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Otdel extends Model
{
    
     public function searchOrg()
    {
        return $this->hasMany(ListTech::class);
    }

    public function nameOtd(){
	
		return $this->belongsTo(ListTech::class);
    
	}

}
