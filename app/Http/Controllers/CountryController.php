<?php

namespace App\Http\Controllers;
use App\Models\Country;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function store(Request $request) {

        if(!$request->id){
            $request->validate([
               'name' => 'required|unique:countries',
               'code' => 'required|unique:countries',
            ]);
            $country = Country::create([
                'name' => $request->name,
                'code' => $request->code,
                'user_id' => auth()->user()->id
            ]);
        } else {
            $country = Country::find($request->id);
            $country->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);
        }

        return redirect()->route('dashboard');

    }

    public function destroy($id) {
        $country = Country::find($id);
        $country->delete();
        return redirect()->route('dashboard');
        // return response()->json(['success' => true, 'message' => 'Country deleted successfully.']);
    }
}
