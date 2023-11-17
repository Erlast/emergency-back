<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;


/**
 * @property int id
 * @property int cartridge_id
 *
 * @method static Builder range($startDate, $endDate)
 * @method static Builder addCartStorage()
 * @method static Builder withOrderByName($direction)
 * @method static Builder withOrderByOnFill($direction)
 * @method static Builder withOrderByFromFill($direction)
 * @method static Builder withOrderByToDepartment($direction)
 * @method static Builder withOrderByFromDepartment($direction)
 */
class CartridgeHistory extends Model
{

    protected $table = 'cartridge_history';

    protected $fillable = ['status_from', 'status_to', 'cartridge_id'];

    /**
     * @return HasOne
     */
    public function cartridge(): HasOne
    {
        return $this->hasOne(Cartstorage::class, 'id', 'cartridge_id');
    }

    public function getOnFill($startDate, $endDate)
    {
        $query = CartridgeHistory::where(['cartridge_id' => $this->cartridge_id, 'status_from' => Cartstorage::DISLOCATION_FILL]);

        if ($startDate && $endDate)
            $query = $query->where('created_at', '>=', Carbon::parse($startDate . ' 00:00:00'))->where('created_at', '<=', Carbon::parse($endDate . ' 23:59:59'));

        return $query->count();

    }

    public function getFromFill($startDate, $endDate)
    {

        $query = CartridgeHistory::where(['cartridge_id' => $this->cartridge_id, 'status_to' => Cartstorage::DISLOCATION_FILL]);

        if ($startDate && $endDate)
            $query = $query->where('created_at', '>=', Carbon::parse($startDate . ' 00:00:00'))->where('created_at', '<=', Carbon::parse($endDate . ' 23:59:59'));

        return $query->count();
    }

    public function getToDepartment($startDate, $endDate)
    {
        $query = CartridgeHistory::where(['cartridge_id' => $this->cartridge_id])
            ->whereNotNull('status_from')
            ->where('status_from', '<>', Cartstorage::DISLOCATION_FILL)
            ->where('status_from', '<>', Cartstorage::DISLOCATION_STORAGE)
            ->where('status_from', '<>', Cartstorage::DISLOCATION_RIP);

        if ($startDate && $endDate)
            $query = $query->where('created_at', '>=', Carbon::parse($startDate . ' 00:00:00'))->where('created_at', '<=', Carbon::parse($endDate . ' 23:59:59'));

        return $query->count();
    }

    public function getFromDepartment($startDate, $endDate)
    {
        $query = CartridgeHistory::where(['cartridge_id' => $this->cartridge_id])
            ->where('status_to', '<>', Cartstorage::DISLOCATION_FILL)
            ->where('status_to', '<>', Cartstorage::DISLOCATION_STORAGE)
            ->where('status_to', '<>', Cartstorage::DISLOCATION_RIP);

        if ($startDate && $endDate)
            $query = $query->where('created_at', '>=', Carbon::parse($startDate . ' 00:00:00'))->where('created_at', '<=', Carbon::parse($endDate . ' 23:59:59'));

        return $query->count();
    }

    public function onStorage($id_name, $endDate)
    {
        return Cartstorage::where('updated_at', '<=', $endDate)->where(['id_name' => $id_name])->count();
    }

    public function scopeRange(Builder $query, string $startDate, string $endDate)
    {
        $query->where('cartridge_history.created_at', '>=', Carbon::parse($startDate . ' 00:00:00'))->where('cartridge_history.created_at', '<=', Carbon::parse($endDate . ' 23:59:59'));
    }

    public function scopeAddCartStorage(Builder $query)
    {
        $query->leftJoin('cartstorages', 'cartstorages.id', '=', 'cartridge_history.cartridge_id');
    }

    public function scopeWithOrderByName(Builder $query, $orderDir)
    {
        $query
            ->addCartStorage()
            ->leftJoin('cartriges', 'cartstorages.id_name', '=', 'cartriges.id')
            ->leftJoin('printmodels', 'cartstorages.id_mod', '=', 'printmodels.id')
            ->orderBy('cartriges.name', $orderDir)
            ->orderBy('printmodels.name', $orderDir);
    }

    public function scopeWithOrderByOnFill(Builder $query, $orderDir)
    {
        $query
            ->select(['cartridge_id', DB::raw("COUNT(if(status_from='на заправке',1,null)) AS cnt")])
            ->addCartStorage()
            ->orderBy('cnt', $orderDir);
    }

    public function scopeWithOrderByFromFill(Builder $query, $orderDir)
    {
        $query
            ->select(['cartridge_id', DB::raw("COUNT(if(status_to='на заправке',1,null)) AS cnt")])
            ->addCartStorage()
            ->orderBy('cnt', $orderDir);
    }

    public function scopeWithOrderByToDepartment(Builder $query, $orderDir)
    {
        $query
            ->select(['cartridge_id', DB::raw('COUNT(if(status_from<>"на заправке" and status_from<>"Склад" and status_from is not NULL and status_from<>"rip",1,null)) as cnt')])
            ->addCartStorage()
            ->orderBy('cnt', $orderDir);
    }

    public function scopeWithOrderByFromDepartment(Builder $query, $orderDir)
    {
        $query
            ->select(['cartridge_id', DB::raw('COUNT(if(status_to<>"на заправке" and status_to<>"Склад" and status_to<>"rip",1,null)) as cnt')])
            ->addCartStorage()
            ->orderBy('cnt', $orderDir);
    }
}
