<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InventoryPayment extends Model
{
    protected $fillable = ['sales_order_id','payment_date','payment_amount','payment_mode','remarks'];

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class);
    }
}
