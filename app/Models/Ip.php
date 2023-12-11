<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string ip_address
 * @property string created_at
 * @property string updated_at
 */
class Ip extends Model
{
    /**
     * @return BelongsTo
     */
    public function workplace(): BelongsTo
    {
        return $this->belongsTo(Workplace::class,"id","ip_id");
    }
}
