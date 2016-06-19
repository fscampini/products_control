<?php

namespace ProductsControl;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_name',
        'client_phone',
        'client_address',
        'client_email',
        'shipment_date',
        'description',
        'status',
        'created_by',
        'last_updated_by'
    ];

    public function user_created(){
        return $this->belongsTo('ProductsControl\User', 'created_by');
    }

    public function user_updated(){
        return $this->belongsTo('ProductsControl\User', 'last_updated_by');
    }

    public function items(){
        return $this->hasMany('ProductsControl\OrderItem');
    }

    public function getStatus(){
        switch ($this->attributes['status'])
        {
            case 0:
                return 'Ordem Gerada';
                break;
            case 1:
                return 'Ordem Entregue';
                break;
            case 2:
                return 'Ordem Cancelada';
                break;
        }
    }
}
