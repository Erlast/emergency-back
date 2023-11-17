<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property int id_name
 * @property int id_mod
 * @property int sh_code
 * @property int status
 * @property string disloc
 * @property int cin
 * @property int act
 * @property string created_at
 * @property string updated_at
 */
class Cartstorage extends Model
{
    const STATUS_STORAGE = 1;
    const STATUS_KILLED = 0;

    const DISLOCATION_STORAGE = "Склад";
    const DISLOCATION_FILL = "на заправке";
    const DISLOCATION_RIP = "rip";

    /**
     * @return HasOne
     */
    public function cartName(): HasOne
    {

        return $this->hasOne(Cartrige::class, 'id', 'id_name');
    }

    /**
     * @return HasOne
     */
    public function printName(): HasOne
    {

        return $this->hasOne(Printmodel::class, 'id', 'id_mod');
    }


}
