<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string created_at
 * @property string updated_at
 */
class Department extends Model
{

     public function searchOrg()
    {
        return $this->hasMany(ListTech::class);
    }

    public function nameOtd(){

		return $this->belongsTo(ListTech::class);

	}

}
