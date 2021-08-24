<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubCategory extends Model
{

    use SoftDeletes;

    public function get_category(){

        // Use Foreign_key name category_id

        return $this->belongsTo('App\Category','category_id');
    }
}
