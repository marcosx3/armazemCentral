<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyResource::collection(Company::with('user','product')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'cnpj' => 'required|min:10|unique:companies',
        ]);
       
        if($validator->fails()){
            return $this->error("Data invalid",422, $validator->errors());
        }

        $created = Company::create($validator->validated());
        if(!$created)
        {
            return $this->error('Something wrong',400);
        }
        return $this->response("Company Created",200,new CompanyResource($created));
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
      return new CompanyResource($company);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'cnpj' => 'required|min:10|unique:companies',
        ]);
       
        if($validator->fails()){
            return $this->error("Data invalid",422, $validator->errors());
        }
        $validated = $validator->validated();
        $updated = $company->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'cnpj' => $validated['cnpj'],
        ]);

        if(!$updated)
        {
            return $this->error('Something wrong',400);
        }
        return $this->response("Company Updated",200,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $deleted = $company->delete();
        if($deleted)
        {
            return $this->response('Comapny deleted',200);
        }
        return $this->error('Comapny not deleted',400);
    }
}
