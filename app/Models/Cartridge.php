<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property int brand_id
 * @property int model_id
 * @property string sh_code
 * @property int status
 * @property int department_id
 * @property int cin
 * @property string created_at
 * @property string updated_at
 */
class Cartridge extends Model
{
    const STATUS_STORAGE = 1;
    const STATUS_FILL = 2;
    const STATUS_DEPARTMENT = 3;
    const STATUS_KILLED = 4;

    //  const DISLOCATION_STORAGE = "Склад";
    //const DISLOCATION_FILL = "на заправке";
    //const DISLOCATION_RIP = "rip";

    /**
     * @return HasOne
     */
    public function brand(): HasOne
    {

        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    /**
     * @return HasOne
     */
    public function printerModel(): HasOne
    {

        return $this->hasOne(PrinterModel::class, 'id', 'model_id');
    }

    public function department(): HasOne
    {

        return $this->hasOne(Department::class, 'id', 'department_id');
    }


}
