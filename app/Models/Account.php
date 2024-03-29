<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Deal;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'zoho_record_id', 'website'];

    public function deal(): HasMany
    {
        return $this->hasMany(Deal::class);
    }
}
