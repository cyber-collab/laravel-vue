<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Account;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = ['deal_name', 'closing_date', 'account_id', 'stage', 'zoho_record_id'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

}
