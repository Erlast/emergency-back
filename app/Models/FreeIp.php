<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FreeIp extends Model
{
    public function findfreeip(){
        return $this->hasOne(ListPc::class,"ip","ip");
    }
}
