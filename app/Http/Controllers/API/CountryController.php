<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    // all countries
    public function index()
    {
        $countries = Country::all()->toArray();
        return array_reverse($countries);
    }
    // add country
    public function add(Request $request)
    {   
        if (Auth::user()->isAdmin()) {
            $country = new Country([
                'name' => $request->name,
                'landmass' => $request->landmass
            ]);
            $country->save();

            return response()->json('The country successfully added');
        }
        return  response()->json(["message" => "Forbidden"], 403);
        
    }

    // edit country
    public function edit($id)
    {
        $country = Country::find($id);
        return response()->json($country);
    }

    // update country
    public function update($id, Request $request)
    {   
        $country = Country::find($id);
        $country->update($request->all());

        return response()->json('The country successfully updated');
    }

    // delete country
    public function delete($id)
    {   
        if (Auth::user()->isAdmin()) {
            $country = Country::find($id);
            $country->delete();

            return response()->json('The country successfully deleted');
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }
}
