<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    protected $fillable = ['category_name','description'];

    public function inventories() {
        return $this->hasMany(Inventory::class, 'category_id');
    }
}
