<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::with('company','products')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password'=> 'required',
            'company_id' => 'required',
        ]);
       
        if($validator->fails()){
            return $this->error("Data invalid",422, $validator->errors());
        }

        $created = User::create($validator->validated());
        if(!$created)
        {
            return $this->error('Something wrong',400);
        }
        return $this->response("User Created",200,new UserResource($created));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'company_id' => 'required',
        ]);
       
        if($validator->fails()){
            return $this->error("Data invalid",422, $validator->errors());
        }
        $validated = $validator->validated();
        $updated = $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_id' => $validated['company_id'],
        ]);

        if(!$updated)
        {
            return $this->error('Something wrong',400);
        }
        return $this->response("User Updated",200,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if($deleted)
        {
            return $this->response('User deleted',200);
        }
        return $this->error('User not deleted',400);
    }
}
