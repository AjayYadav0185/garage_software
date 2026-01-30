<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends BaseModel
{
    use HasFactory;

    protected $table = 'payment_history';

    /**
     * We are manually controlling timestamps
     */
    public $timestamps = false;

    /**
     * Mass-assignable fields
     */
    protected $fillable = [
        'g_id',
        'c_id',
        'jobcard_id',
        'inc_id',          // ✅ insurance company
        'amount',
        'status',          // C / P
        'payment_type',    // insurance | customer
        'mark_in',    // cash | card | bank transfer
        'created_at',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'amount'     => 'float',
        'created_at' => 'datetime',
    ];

    /* =======================
     |  Relationships
     ======================= */

    public function jobCard()
    {
        return $this->belongsTo(JobCard::class, 'jobcard_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id', 'c_id');
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'inc_id');
    }

    public function garage()
    {
        return $this->belongsTo(User::class, 'g_id', 'g_id');
    }

    /* =======================
     |  Helpers (optional)
     ======================= */

    public function isInsurance()
    {
        return $this->payment_type === 'insurance';
    }

    public function isCustomer()
    {
        return $this->payment_type === 'customer';
    }
}
