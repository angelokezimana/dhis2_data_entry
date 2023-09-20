<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataElement extends BaseModel
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
        'data_set_id',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'hiv_testings');
    }

    public function dataSet()
    {
        return $this->belongsTo(DataSet::class, 'data_set_id');
    }
}
