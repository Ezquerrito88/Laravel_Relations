<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'zipcode' => 'required|numeric|digits:5',
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        $user = User::where('email',Request('email'))->firstOrFail();
        if ($user->address) {
            return response()->json(["message" => "The address already exists!"], 400);
        }

        $address = new Address(request(['country','zipcode']));



        if ($user->address()->save($address)){
            return response()->json(['message' => 'Address Created', 'data' => $address], 200);
        }

        return response()->json(['message' => 'Failed', 'data' => null], 400);
    }

    public function show(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address], 200);
    }

    public function show_user(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address->user], 200);
    }
}
