<?php

namespace App\Http\Controllers;

use App\Http\Resources\InsurancePolicyResource;
use App\Models\InsurancePolicy;
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
     * @param  \Illuminate\Http\Request  $request
     * @return InsurancePolicyResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $insurancePolicy = InsurancePolicy::create($request->validated());

        return new InsurancePolicyResource($insurancePolicy);
    }

    /**
     * Display the specified resource.
     *
     * @param InsurancePolicy $insurancePolicy
     * @return InsurancePolicyResource|\Illuminate\Http\JsonResponse|object
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(InsurancePolicy $insurancePolicy)
    {
        $insurancePolicy->delete();

        return response()->json([], 204);
    }
}
