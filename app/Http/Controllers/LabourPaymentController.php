<?php
namespace App\Http\Controllers;
use App\Models\LabourPayment;
use App\Models\LabourBill;
use Illuminate\Http\Request;

class LabourPaymentController extends Controller
{
    public function index(Request $request)
    {
        $billId = $request->query('labour_bill_id');
        $query = LabourPayment::with('labourBill');
        if ($billId) {
            $query->where('labour_bill_id', $billId);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'labour_bill_id' => 'required|exists:labour_bills,id',
            'amount' => 'required|numeric',
            'payment_date' => 'nullable|date',
            'payment_mode' => 'nullable|string',
            'remarks' => 'nullable|string'
        ]);
        
        $payment = LabourPayment::create($validated);
        
        // Update bill status
        $bill = LabourBill::find($validated['labour_bill_id']);
        $totalPaid = $bill->labourPayments()->sum('amount');
        if ($totalPaid >= $bill->amount) {
            $bill->status = 'Paid';
        } elseif ($totalPaid > 0) {
            $bill->status = 'Partially Paid';
        } else {
            $bill->status = 'Pending';
        }
        $bill->save();

        return response()->json($payment, 201);
    }

    public function destroy(LabourPayment $labourPayment)
    {
        $bill = $labourPayment->labourBill;
        $labourPayment->delete();
        
        // Update bill status
        $totalPaid = $bill->labourPayments()->sum('amount');
        if ($totalPaid >= $bill->amount) {
            $bill->status = 'Paid';
        } elseif ($totalPaid > 0) {
            $bill->status = 'Partially Paid';
        } else {
            $bill->status = 'Pending';
        }
        $bill->save();
        
        return response()->json(null, 204);
    }
}