<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'kind_id', 'age', 'size', 'food', 'state'];
    protected $hidden = ['created_at', 'updated_at'];

    public function kind(): BelongsTo
    {
        return $this->belongsTo(Kind::class);
    }
}
