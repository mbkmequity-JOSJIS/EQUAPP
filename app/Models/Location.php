<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
    ];

    /**
     * Get all equipment for this location
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    /**
     * Get count of normal equipment
     */
    public function getNormalEquipmentCount(): int
    {
        return $this->equipment()->where('status', 'normal')->count();
    }

    /**
     * Get count of broken/offline equipment
     */
    public function getBrokenEquipmentCount(): int
    {
        return $this->equipment()->whereIn('status', ['warning', 'broken'])->count();
    }
}
