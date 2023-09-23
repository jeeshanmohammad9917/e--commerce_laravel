<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $primaryKey = 'id';

    protected $fillable = [
        'payment_id',
        'user_id',
        'order_id',
        'email',
        'contact',
        'amount',
        'status',
        'notes',
        'invoice_id',
        'method',
        'amount_refunded',
        'refund_status',
        'captured',
        'description',
        'bank',
        'wallet',
        'vpa',
        'fee',
        'tax',
        'error_code',
        'error_description',
        'error_source',
        'error_step',
        'error_reason',
        'acquirer_data'
    ];
    public function getProductData()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
