<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    /**
     * @var string $table
     */
    protected $table = 'studios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'studio_number',
        'seat_capacity',
        'deleted_at'
    ];

    public function movieSchedules(){
        return $this->hasMany(MovieSchedule::class);
    }
}
