<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InventoryStockHistory extends Model
{
    protected $fillable = ['inventory_id','change_type','quantity','previous_stock','new_stock','remarks'];

    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }
}
