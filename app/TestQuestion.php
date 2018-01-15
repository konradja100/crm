<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    public function category() {
        return $this->belongsTo('App\TestCategories', 'category_id');
    }

    public function userQuestion() {
        return $this->hasOne('App\UserQuestion', 'question_id');
    }
}
