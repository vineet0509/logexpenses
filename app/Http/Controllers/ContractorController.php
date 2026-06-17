<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContractorRequest;
use App\Http\Requests\UpdateContractorRequest;
use App\Http\Resources\ContractorResource;

class ContractorController extends Controller
{
    public function index()
    {
        $contractors = Contractor::paginate(15);
        return ContractorResource::collection($contractors);
    }

    public function store(StoreContractorRequest $request)
    {
        $contractor = Contractor::create($request->validated());
        return new ContractorResource($contractor);
    }

    public function show(string $id)
    {
        $contractor = Contractor::findOrFail($id);
        return new ContractorResource($contractor);
    }

    public function update(UpdateContractorRequest $request, string $id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->update($request->validated());
        return new ContractorResource($contractor);
    }

    public function destroy(string $id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->delete();
        return response()->json(null, 204);
    }

    public function nearLocation($location)
    {
        $contractors = Contractor::where('location', 'like', "%{$location}%")->paginate(15);
        return ContractorResource::collection($contractors);
    }
}
