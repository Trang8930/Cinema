<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\User;
use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use App\Mail\ConfirmRegisterMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Backend\CreateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->with("city");
        
        if(Auth::user()->id != 1) {
            $cityID = Auth::user()->city_id;
            $users->where("city_id", $cityID);
        }
        $users = $users->get();

        return view('backend.users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create', ['cities' => City::get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Backend\CreateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $check = 0;
        $fileName = null;
        $role = User::IS_USER;
        if ($request->has('image') && $request->image != null) {
            $image = $request->file('image');
            $fileName = config('image.path') . 'img' . '-' . time() . '.' . $image->getClientOriginalExtension();
            $filePath = public_path('images/');
            $request->file('image')->move($filePath, $fileName);
        }
        if(User::count() == 0) {
            $role = User::IS_ADMIN;
        }
        try {
            $result = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => $request->password,
                'username' => $request->username,
                'image' => $fileName ,
                'birthday' => $request->birthday,
                'access_token' => str_random(100),
                'role' => $role,
                'city_id' => $request->city_id
            ]);
            if ($result) {
                $user = User::where('email', $request->email)->first();
                SendMailJob::dispatch($user);
            }
            $check = 1;
            return redirect()->route('users.index', compact('check'));
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('users.index', compact('check'));
        } catch (Exception $e) {
            $check = 0;
            return redirect()->route('users.index', compact('check'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $accessToken
     * @return \Illuminate\Http\Response
     */
    public function show($accessToken)
    {
        return view('backend.users.show', ['user' => User::where('access_token', $accessToken)->firstOrFail()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $accessToken
     * @return \Illuminate\Http\Response
     */
    public function edit($accessToken)
    {
        return view('backend.users.update', ['user' => User::where('access_token', $accessToken)->firstOrFail()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $accessToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $accessToken)
    {
        $user = User::where('access_token', $accessToken)->firstOrFail();
        $check = 0;
        $fileName = null;
        $oldImage = null;
        if ($user->image != null) {
            $oldImage = $user->image;
        }
        try {
            if ($request->has('image') && $request->image != null) {
                $image = $request->file('image');
                $fileName = config('image.path') . 'img' . '-' . time() . '.' . $image->getClientOriginalExtension();
                $filePath = public_path('images/');
                $request->file('image')->move($filePath, $fileName);
            } else {
                $fileName = $user->image;
            }
            
            if ($request->password == null) {
                $request->password = $user->password;
            }
            $result = $user->update([
                'password' => $request->password,
                'fullname' => $request->fullname,
                'birthday' => $request->birthday,
                'image' => $fileName
            ]);
    
            if(\File::exists($user->image) && $result && $oldImage != null && $request->has('image')) {
                $delteImg = public_path() . '/' . $oldImage;
                \File::delete($delteImg);
            }
            $check = 2;
            return redirect()->route('users.index', compact('check'));
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('users.index', compact('check'));
        } catch (Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('users.index', compact('check'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $accessToken
     * @return \Illuminate\Http\Response
     */
    public function destroy($accessToken)
    {
        \DB::beginTransaction();
        try {
            $user = User::where('access_token', $accessToken)->firstOrFail();
            $image = $user->image;
            $result = $user->delete();
            if(\File::exists($image) && $result) {
                $fileName = public_path() . '/' . $image;
                \File::delete($fileName);
            }
            \DB::commit();
            $check = 3;
            return redirect()->route('users.index', compact('check'));
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('users.index', compact('check'));
        } catch (Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('users.index', compact('check'));
        }
    }

    /**
     * Update is_active of user.
     *
     * @param  String $access_token token of user
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateActive($access_token)
    {
        $user = User::where('access_token', $access_token)->firstOrFail();
        if ($user->role == User::IS_ADMIN && Auth::user()->id != User::ID_MASTER) {
            return;
        }
        if ($user->is_active  == User::NOT_ACTIVE) {
            $user->update([
                'is_active' => User::IS_ACTIVE
            ]);
        } else {
            $user->update([
                'is_active' => User::NOT_ACTIVE
            ]);
        }
        
        if (request()->ajax()) {
            return response()->json($user, 200);
        }
    }

    /**
     * Update role of user.
     *
     * @param  String $access_token token of user
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateRole($access_token)
    {
        $user = User::where('access_token', $access_token)->firstOrFail();
        if ($user->role == User::IS_ADMIN && Auth::user()->id != User::ID_MASTER) {
            return;
        }
        if ($user->role  == User::IS_USER) {
            $user->update([
                'role' => User::IS_ADMIN
            ]);
        } else {
            $user->update([
                'role' => User::IS_USER
            ]);
        }
        if (request()->ajax()) {
            return response()->json($user, 200);
        }
    }
}
