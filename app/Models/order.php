<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'sub_total',
        'shipping',
        'tax_amount',
        'tax_rate',
        'amount',
        'comment',
        'status',
    ];
    public function customerData()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->select('id', 'fname', 'lname');
    }

    public function lineitemsData()
    {
        return $this->hasMany(lineitem::class, 'order_id', 'id');
    }
}
