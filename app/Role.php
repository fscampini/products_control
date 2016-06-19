<?php

namespace ProductsControl;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'last_updated_by'
    ];

    public function user_created(){
        return $this->belongsTo('ProductsControl\User', 'created_by');
    }

    public function user_updated(){
        return $this->belongsTo('ProductsControl\User', 'last_updated_by');
    }

    public function permissions(){
        return $this->belongsToMany('ProductsControl\Permission');
    }
}
