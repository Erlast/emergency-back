<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property int id
 * @property int user_id
 * @property string token
 * @property string expires_at
 * @property string created_at
 * @property string updated_at
 */
class UserRefreshToken extends Model
{
    const BASE_EXPIRES_AT_DAYS = 120;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->token = Uuid::uuid4();
            $model->expires_at = Carbon::now()->addDays(self::BASE_EXPIRES_AT_DAYS)->format('Y-m-d H:i:s');
        });
    }

    public function getExpiresAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
