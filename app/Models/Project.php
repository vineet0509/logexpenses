<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function user() { return $this->belongsTo(User::class); }
    public function vendors() { return $this->hasMany(Vendor::class); }
    public function bills() { return $this->hasMany(Bill::class); }
    public function labourContractors() { return $this->hasMany(LabourContractor::class); }
    public function labourBills() { return $this->hasMany(LabourBill::class); }
}