<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kind extends Model
{
    use HasFactory;

    protected $fillable = ['kind', 'max_age', 'max_size', 'growth_factor', 'img'];
    protected $hidden = ['created_at', 'updated_at'];

    public function animals(): HasMany
    {
         return $this->hasMany('App\Models\Animal', 'kind_id');
    }
}
