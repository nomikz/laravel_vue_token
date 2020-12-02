<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsurancePolicyCreateRequest;
use App\Http\Requests\InsurancePolicyGetByIinRequest;
use App\Http\Resources\InsurancePolicyResource;
use App\Models\InsurancePolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InsurancePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $iin
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getByIin($iin)
    {
        $policies = InsurancePolicy
            ::where('iin', $iin)
            ->get();

        return InsurancePolicyResource::collection($policies);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $policies = InsurancePolicy
            ::orderBy('created_at')
            ->paginate(20);

        return InsurancePolicyResource::collection($policies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InsurancePolicyCreateRequest $request
     * @return InsurancePolicyResource|JsonResponse
     */
    public function store(InsurancePolicyCreateRequest $request)
    {
        $collection = collect($request->validated());

        $policyArray = $collection->except('additionalDrivers')->all();
        $driversArray = $collection->only('additionalDrivers')->first();

        try {
            $insurancePolicy = InsurancePolicy::create($policyArray);

            if ($insurancePolicy) {
                foreach($driversArray as $driver) {
                    $insurancePolicy
                        ->additionalDrivers()
                        ->create($driver);
                }
            }

            return new InsurancePolicyResource($insurancePolicy);
        } catch (\Exception $exception) {
            Log::error(
                $exception->getMessage(),
                $exception->getTrace()
            );

            return response()->json(
                [
                    'message' => 'Service is not available.',
                ],
                400
            );
        }
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
     * @return JsonResponse
     */
    public function update(Request $request, InsurancePolicy $insurancePolicy)
    {
         return response()->json(null, 401);
//        $insurancePolicy->update($request->validated());
//
//        return new InsurancePolicyResource($insurancePolicy);
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
        return response()->json(null, 401);
//        $insurancePolicy->delete();
//
//        return response()->json([], 204);
    }
}
