<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ListTech extends Model
{
     public function searchDetalisation(){
#	    
	    return $this->hasOne(Cartrige::class,'id','cartrige_id');
    }

    public function printName(){
	
	return $this->hasOne(Printmodel::class,'id','printmodel_id');
    }

    public function otdName(){

	return $this->hasOne(Otdel::class, 'id', 'otdel_id');

    }

}
