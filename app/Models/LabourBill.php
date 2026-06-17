<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabourBill extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function labourContractor() { return $this->belongsTo(LabourContractor::class); }
    public function labourPayments() { return $this->hasMany(LabourPayment::class); }
}