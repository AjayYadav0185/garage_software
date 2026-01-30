<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
        // Disable automatic timestamps if you don't need 'created_at' and 'updated_at'
    public $timestamps = false;
    
    protected $fillable = ['sales_order_id','inventory_id','quantity','unit_price','total_price'];

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class);
    }

    public function inventory() {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}
