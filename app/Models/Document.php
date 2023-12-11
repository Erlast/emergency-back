<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int section_id
 * @property string name
 * @property string url
 * @property string created_at
 * @property string updated_at
 */
class Document extends Model
{

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

}
