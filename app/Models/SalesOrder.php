<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends BaseModel
{
    // Add 'status' to fillable
    protected $fillable = [
        'g_id',
        'client_id',
        'order_date',
        'total_amount',
        'status',          // ✅ new column
        'payment_status'
    ];

    // Relationship with client
    public function client() {
        return $this->belongsTo(InventoryClient::class, 'client_id');
    }

    // Relationship with sales order items
    public function items() {
        return $this->hasMany(SalesOrderItem::class);
    }

    // Relationship with payments
    public function payments() {
        return $this->hasMany(InventoryPayment::class);
    }
}
