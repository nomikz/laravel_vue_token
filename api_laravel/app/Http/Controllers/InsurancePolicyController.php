<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsurancePolicyCreateRequest;
use App\Http\Resources\InsurancePolicyResource;
use App\Models\InsurancePolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsurancePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $policies = InsurancePolicy
            ::orderBy('created_at')
            ->paginate(8);

        return InsurancePolicyResource::collection($policies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsurancePolicyCreateRequest $request
     * @return InsurancePolicyResource
     */
    public function store(InsurancePolicyCreateRequest $request)
    {
        $insurancePolicy = InsurancePolicy::create($request->validated());

        return new InsurancePolicyResource($insurancePolicy);
    }

    /**
     * Display the specified resource.
     *
     * @param InsurancePolicy $insurancePolicy
     * @return InsurancePolicyResource|JsonResponse|object
     */
    public function show(InsurancePolicy $insurancePolicy)
    {
        return new InsurancePolicyResource($insurancePolicy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param InsurancePolicy $insurancePolicy
     * @return InsurancePolicyResource
     */
    public function update(Request $request, InsurancePolicy $insurancePolicy)
    {
        $insurancePolicy->update($request->validated());

        return new InsurancePolicyResource($insurancePolicy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InsurancePolicy $insurancePolicy
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(InsurancePolicy $insurancePolicy)
    {
        $insurancePolicy->delete();

        return response()->json([], 204);
    }
}
