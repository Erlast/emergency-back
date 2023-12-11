<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string surname
 * @property string name
 * @property string middle_name
 * @property string created_at
 * @property string updated_at
 */
class Person extends Model
{

    protected $table = 'persons';

    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return trim($this->surname . ' ' . $this->name . " " . $this->middle_name);
    }
}
