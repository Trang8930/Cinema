<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\User;
use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use App\Mail\ConfirmRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'fullname' => 'required|min:3',
            'email' => 'required|min:3|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|max:18',
            'password_confirmation' => 'required|max:18',
            'birthday' => 'required|date',
            'image' => 'image|nullable'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $fileName = null;
        $role = User::IS_USER;
        if (request()->has('image')) {
            $image = request()->file('image');
            $fileName = config('image.path') . 'img' . '-' . time() . '.' . $image->getClientOriginalExtension();
            $filePath = public_path('images/');
            request()->file('image')->move($filePath, $fileName);
        }
        if(User::count() == 0) {
            $role = User::IS_ADMIN;
        }
        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'username' => $data['username'],
            'image' => $fileName ,
            'birthday' => $data['birthday'],
            'access_token' => str_random(100),
            'role' => $role,
            'city_id' => $data['city_id']
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        // try {
            if ($user) {
                SendMailJob::dispatch($user);
            }
        // } catch (\Exception $e) {
                        
        // }

        return redirect()->route('confirm.view');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', ['cities' => City::get()]);
    }

}
