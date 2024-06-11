<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('order', function (Builder $builder) {
    //         $builder->orderBy('created_at', 'desc');
    //     });
    // }

    public function scopeOrderByName($query, $direction = 'asc')
    {
        return $query->orderBy('item_name', $direction);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class, 'purchase_request_id');
    }
}
