<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends BaseModel
{
    protected $table = 'insurence_details';
    protected $primaryKey = 'id';
    public $timestamps = false; // created_at is manually handled

    protected $fillable = [
        'g_id',
        'insurence_company_name',
        'insurence_code',
        'insurence_tax_number',
        'claim_number',
        'policy_number',
        'whatsapp_number',
        'voice_of_customer_insurencen',
        'insurence_company_number',
        'insurence_email_address',
        'insurence_emirates',
        'insurence_driver_name',
        'insurence_driver_mobile_number',
        'insure_address',
        'created_at',
    ];

    // Relationship with JobCard
    public function jobcards()
    {
        return $this->hasMany(JobCard::class, 'insurance_company_id', 'id');
    }
    
}
