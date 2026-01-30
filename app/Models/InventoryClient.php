<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InventoryClient extends BaseModel
{
    protected $fillable = ['g_id','name','email','phone','address'];

    public function salesOrders() {
        return $this->hasMany(SalesOrder::class, 'client_id');
    }

    
}
