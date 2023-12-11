<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property int department_id
 * @property int ip_id
 * @property int person_id
 * @property string mac_address
 * @property string inventory_number
 * @property string serial_number
 * @property string name
 * @property int level
 * @property int room
 * @property int office
 * @property int operating_system_id
 * @property string os_serial_number
 * @property int programming_office
 * @property string po_serial_number
 * @property string created_at
 * @property string updated_at
 */
class Workplace extends Model
{
    const SERIAL_FREE = 'Free';

    /**
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function ip(): BelongsTo
    {
        return $this->belongsTo(Ip::class, 'ip_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function operatingSystem(): HasOne
    {
        return $this->hasOne(OperatingSystem::class, 'id', 'operating_system_id');
    }

}
