<?php

namespace ProductsControl;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'route_description',
        'font_awesome_description',
        'name',
        'parent_menu_id',
        'created_by',
        'last_updated_by'
    ];

    public function user_created(){
        return $this->belongsTo('ProductsControl\User', 'created_by');
    }

    public function user_updated(){
        return $this->belongsTo('ProductsControl\User', 'last_updated_by');
    }

    public function documentHistory(){
        return $this->hasMany('ProductsControl\DocumentHistory');
    }

    public function users()
    {
        return $this->belongsToMany('ProductsControl\User');
    }

    public function child_menus()
    {
        return $this->hasMany('ProductsControl\Menu', 'parent_menu_id', 'id');
    }

    public function parent_menu()
    {
        return $this->belongsTo('ProductsControl\Menu', 'parent_menu_id');
    }
}
