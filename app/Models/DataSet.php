<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSet extends BaseModel
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

    public function organisations()
    {
        return $this->belongsToMany(OrganisationUnit::class, 'data_set_organisation');
    }

    public function dataElements()
    {
        return $this->hasMany(DataElement::class, 'data_set_id');
    }
}
