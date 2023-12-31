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

    public function users()
    {
        return $this->belongsToMany(User::class, 'organisation_users');
    }

    public function dataSets()
    {
        return $this->belongsToMany(DataSet::class, 'data_set_organisation');
    }
}
