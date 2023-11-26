<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ListTech extends Model
{
     public function searchDetalisation(){
#
	    return $this->hasOne(Cartridge::class,'id','cartrige_id');
    }

    public function printName(){

	return $this->hasOne(PrinterModel::class,'id','printmodel_id');
    }

    public function otdName(){

	return $this->hasOne(Department::class, 'id', 'otdel_id');

    }

}
