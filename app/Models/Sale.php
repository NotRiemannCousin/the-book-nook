<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'percentage',
        'until'
    ];

    protected $casts = [
        'percentage' => 'float',
        'until' => 'datetime'
    ];
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
