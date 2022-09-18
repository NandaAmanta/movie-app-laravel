<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSchedule extends Model
{
    use HasFactory;
    /**
     * @var string $table
     */
    protected $table = 'movie_schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_id',
        'studio_id',
        'start_time',
        'end_time',
        'price',
        'date',
        'deleted_at'
    ];
}
