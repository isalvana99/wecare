<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['string', 'max:255', 'nullable'],
            'lastname' => ['string', 'max:255', 'nullable'],
            'middlename' => ['string', 'max:255', 'nullable'],
            'day' => ['string', 'max:255', 'nullable'],
            'month' => ['string', 'max:255', 'nullable'],
            'year' => ['string', 'max:255', 'nullable'],
            'age' => ['string', 'max:255', 'nullable'],
            'sex' => ['string', 'max:255', 'nullable'],
            'sector' => ['nullable', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:14'],
            'phone_number2' => ['required', 'string', 'min:8'],
            'license' => ['nullable', 'string', 'min:8'],
            'org_name' => ['string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_image' => 'image|nullable|max:1999',
            'verified' => ['string', 'max:255'],
            'role' => ['string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $id = random_int(100000000000, 999999999999);
        $phcode = $data['phone_number'];
        if($phcode == "+63")
        {
            $phcode = "0";
        }
        return User::create([
            'id' => random_int(100000000000, 999999999999),
            'firstName' => $data['firstname'],
            'lastName' => $data['lastname'],
            'middleName' => $data['middlename'],
            'birthday' => $data['year'].$data['month'].$data['day'],
            'sex' => $data['sex'],
            'sector' => $data['sector'],
            'barangay' => $data['barangay'],
            'city' => $data['city'],
            'province' => $data['province'],
            'region' => $data['region'],
            'orgName' => $data['org_name'],
            'phoneNumber' => $phcode.$data['phone_number2'],
            'license' => $data['license'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profileImage' => 'noimage.jpg',
            'accountVerified' => 'NOT VERIFIED',
            'role' => $data['role'],
        ]);
    }
}
