<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateUserRequest extends Model
{
    protected $fillable = ['person_id', 'fields', 'from'];

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id', 'id');
    }
}
