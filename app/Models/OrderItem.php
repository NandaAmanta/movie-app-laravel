<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    /**
     * @var string $table
     */
    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'movie_schedule_id',
        'qty',
        'price',
        'sub_total_price',
        'snapshots',
        'deleted_at'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        "deleted_at"
    ];
}
