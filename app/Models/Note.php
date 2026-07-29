<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'noteable_type',
    'noteable_id',
    'title',
    'note',
    'created_by',
])]
class Note extends Model
{
    use HasFactory;

    /**
     * Get the parent noteable model.
     */
    public function noteable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who created the note.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
