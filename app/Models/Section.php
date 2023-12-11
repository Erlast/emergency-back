<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int p_id
 * @property string name
 * @property string slug
 * @property int is_share
 * @property int order
 * @property string created_at
 * @property string updated_at
 */
class Section extends Model
{

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'p_id', 'id')->with(['children', 'documents']);
    }

    /**
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'section_id', 'id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'p_id', 'id')->with('parent');
    }
}
