<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId)
    {
        $user = User::find($userId);

        return view('users.settings', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage mobile number vefrifed using Numverify,,,
     */
    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'phone_number' => 'required|numeric',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
        ]);

        $number = $request->input('phone_number');

        $access_key = 'f3b142e2d7461b11e1f1a2aae9658fde';
        $url = "http://apilayer.net/api/validate?access_key={$access_key}&number={$number}";

        try {
            $client = new Client();
            $response = $client->get($url);

            $data = json_decode($response->getBody(), true);
            // dd($data);
            if ($data['valid']) {
                $user = User::find($id);

                $update = $user->update([
                    'email' => $input['email'],
                    'phone_number' => $input['phone_number'],
                ]);

                return redirect()->back()->with('phoneSuccess', 'Phone number is valid');
            } else {

                return redirect()->back()->withInput()->withErrors(['phone' => 'Invalid phone number.']);
            }
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->withErrors(['phone' => 'Error occurred while checking the phone number.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
