<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\PaymentResource;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::whereHas('project', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->with(['project', 'contractor'])->paginate(15);

        return PaymentResource::collection($payments);
    }

    public function store(StorePaymentRequest $request)
    {
        $project = \App\Models\Project::findOrFail($request->project_id);
        Gate::authorize('view', $project);

        $payment = Payment::create($request->validated());
        return new PaymentResource($payment);
    }

    public function show(string $id)
    {
        $payment = Payment::with(['project', 'contractor'])->findOrFail($id);
        Gate::authorize('view', $payment);
        
        return new PaymentResource($payment);
    }

    public function update(UpdatePaymentRequest $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        Gate::authorize('update', $payment);

        if ($request->has('project_id')) {
            $project = \App\Models\Project::findOrFail($request->project_id);
            Gate::authorize('view', $project);
        }

        $payment->update($request->validated());
        return new PaymentResource($payment);
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        Gate::authorize('delete', $payment);
        
        $payment->delete();
        return response()->json(null, 204);
    }

    public function byProject($projectId)
    {
        $project = \App\Models\Project::findOrFail($projectId);
        Gate::authorize('view', $project);
        
        $payments = Payment::with(['project', 'contractor'])->where('project_id', $projectId)->paginate(15);
        return PaymentResource::collection($payments);
    }
}
