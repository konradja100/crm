<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_types extends Model
{
    protected $table = 'department_type';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','count_agreement'
    ];

    public function department_info() {
        return $this->hasMany('App\Department_info', 'id_dep_type');
    }
}
