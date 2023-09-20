<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganisationUnit extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'display_name',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'organisation_users');
    }
}
