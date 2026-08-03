<?php

namespace App\Models;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'name',
    'email',
    'phone',
    'status',
    'created_by',
    'updated_by',
])]
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get all addresses for the customer.
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get all notes for the customer.
     */
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    /**
     * Get all attachments for the customer.
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get the company associated with the customer.
     */
    public function company()
    {
        return $this->morphOne(Company::class, 'companyable');
    }

    /**
     * Get the user who created the customer.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the customer.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the address associated with the customer
     *
     * @return MorphOne
     */
    public function officeAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', AddressType::Office);
    }
}
