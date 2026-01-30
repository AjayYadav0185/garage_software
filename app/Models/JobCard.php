<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCard extends BaseModel
{
    use HasFactory;

    protected $table = 'jobcard';

    protected $fillable = [
        'g_id',
        'c_id',
        'v_id',
        'uid',
        'm_id',
        'insurance_company_id',
        'invoice_no',
        'name',
        'contact',
        'email',
        'c_gst',
        'address',
        'carbrand',
        'carmodel',
        'fueltype',
        'registration',
        'chassis_no',
        'odometer',
        'transmission',
        'braking',
        'fuelmeter',
        'img1',
        'img2',
        'document',
        'inventory',
        'service',
        'insurance_company',
        'insexpiry',
        'voice_of_customer',
        'instruction_for_mechanic',
        'remark',
        'totalPrice',
        'total_price_without_insurance',
        'dueamount',
        'status',
        'payment_method',
        'split_billing',
        'liability_percentage',
        'liability_amount',
        'part_discount',
        'service_discount',
        'packageDiscount',
        'packageDiscountAmount',
        'work_status',
        'assigned_mechanic',
        'service_due_date',
        'completed_work_date',
        'amount_receive_insurance_company_date',
        'job_card_type',
        'job_card_no',
        'insurance_code',
        'insurance_gstin',
        'insurance_claim_number',
        'insurance_policy_number',
        'policy_no',
        'claim_no',
        'lpo_no',
        'insurance_company_name',
        'insurance_tax_number',
        'insurance_company_contact',
        'insurance_email_address',
        'insurance_company_whatsapp_number',
        'insurance_company_address',
        'insurance_emirates',
        'status_accident',
        'driver_name',
        'driver_mobile_number'
    ];


    /**
     * Optional: if services/parts are stored in a separate table
     */
    public function payment()
    {
        return $this->hasMany(PaymentHistory::class, 'jobcard_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'v_id', 'v_id');
    }

    public function garage()
    {
        return $this->belongsTo(User::class, 'g_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id', 'c_id');
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'insurance_company_id', 'id');
    }
}
