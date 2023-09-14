<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomUser;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Import the Session facade

use function PHPUnit\Framework\matches;

class AccountController extends Controller
{

    public function home()
    {
        return view('home');
    }

    // public function validateInput(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'first_name' => ['required', 'alpha', 'max:255'],
    //         'last_name' => ['required', 'alpha', 'max:255'],
    //         'email' => $request->remail ['required', 'email', 'unique:customusers'],
    //         'password' => ['required', 'string', 'min:8' , 'max:255']
    //     ]);

    //     if ($validator->fails()) {
    //         return false ;
    //     } else {
    //         return true ;
    //     }
    // }

    public function validateInput(Request $request)
    {
        // Define the validation rules mapping the HTML input field names to database column names
        $rules = [
            'first_name' => ['required', 'alpha', 'max:255'],
            'last_name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'email', 'unique:customusers'],
            'password' => ['required', 'string', 'min:8', 'max:255']
        ];

        // Rename the 'remail' input to 'email' for validation purposes
        $request->merge(['email' => $request->remail]);
        $request->merge(['password' => $request->rpassword]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session('user_id')){
            return AccountController::edit(session('user_id'));
            // return view('accounts.profile');
        } else {
            return view('accounts.index');
        }
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
    // public function store(Request $request)
    // {

    //     if ($this->validateInput($request)) {
    //         try {
    //             CustomUser::create([
    //                 'first_name' => $request->first_name,
    //                 'last_name' => $request->last_name,
    //                 'email' => $request->remail,
    //                 'password' => bcrypt($request->rpassword),
    //                 'role_id' => 2
    //             ]);

    //             // Redirect on success
    //             return redirect()->route('account.index')->with('success', 'Registered Successfully');
    //         } catch (\Exception $e) {

    //             return redirect()->back()->with('error', 'Registration Failed');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Email already exists');
    //     }

    // }

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
        if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
            Session::put('error', ' Invalid Email Format.');
            return redirect()->route('account.index');
            }
        $existingUser = CustomUser::where('email', $request->input('email'))->first();
        if ($existingUser) {
            Session::put('error', 'Email already exists. Please choose a different email.');
            return redirect()->route('account.index');
        }
        if ($request->input('password')) {
            if(strlen($request['password'])>=8){
            if($request['password']==$request['confirm']){
                $user = new CustomUser();
                $user->first_name = $request->input('first_name');
                $user->last_name = $request->input('last_name');
                $user->email = $request->input('email');
                $user->role_id = 2;
                $user->password = bcrypt($request->input('password'));
                $user->save();
                Auth::login($user);
                Session::put('role_id', $user->role_id);
                Session::put('user_id', $user->id);
                Session::put('user_name', $user->first_name);
                Session::put('error', '');
                return redirect()->route('products.index')->with('success', 'Registration Successful');
        }
            else{
                Session::put('error2', 'Password Missmatch.');
                return redirect()->route('account.index');
            }}
            else{
                Session::put('error2', 'Password has to be 8 or more characters.');
                return redirect()->route('account.index');
            }
        }
    }



    public function login(Request $request)
    {
        $user = CustomUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->first_name);
            Session::put('role_id', $user->role_id);

            if ($user->role_id == 2) {
                return redirect()->route('products.index')->with('success', 'Login Successful');
            } else {
                return redirect()->route('admin.index')->with('success', 'Login Successful');
            }
        } else {
            return redirect()->route('account.index')->with('error', 'Invalid Email Or Password');
        }
    }

    public function logout()
    {
        // Auth::logout(); // Logout the currently authenticated user
        Session::flush(); // Clear all session data

        return redirect()->route('account.index')->with('success', 'Logout Successful');
    }


    // public function login(Request $request)
    // {
    //     $user = CustomUser::where('email', '=', $request->email)->first(); // Use first() to get the user

    //     // dd($user);

    //     if ($user) {
    //         if (Hash::check($request->password, $user->password)) { // Use Hash::check to verify the password
    //             // Log in the user (you may need to implement authentication logic here)
    //             // For example, you can use Laravel's built-in Auth::login() method

    //             // Redirect to the home page on successful login
    //             session_start();
    //             $_SESSION['user_id'] = $user->id ;
    //             $_SESSION['user_name'] = $user->first_name ;
    //             // dd($_SESSION['user_id']);
    //             return redirect()->route('home')->with('success', 'Login Successful');
    //         } else {
    //             // Invalid password
    //             return redirect()->route('account.index')->with('error', 'Invalid Email Or Password');
    //         }
    //     } else {
    //         // User not found
    //         return redirect()->route('account.index')->with('error', 'Account Does Not Exist');
    //     }
    // }


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
        $user = CustomUser::find($id);
        return view('accounts.profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = CustomUser::find($id);

        // Validate the incoming data
        $request->validate([
            'first_name' => ['required', 'alpha', 'max:255'],
            'last_name' => ['required', 'alpha', 'max:255'],
            // 'email' => ['required', 'email', 'unique:customusers'],
            'password' => ['required', 'string', 'min:8' , 'max:255'] ,
            'new_pass' => ['required', 'string', 'min:8' , 'max:255']
        ]);

        // $oldhashed = Hash::make($request->password);
        // if ($oldhashed == $user->password ) {
        // if(Hash::check($request->password , $user->password)) {
        // if (password_verify($request->password , $user->password)) {
            // Old password matches, update the user's information

        // dd($request);

        if ($request->filled('password') && !Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('account.index')->with('error', 'Old Password does not match');
        } else {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                // 'password' => $request->new_pass
                // 'password' => bcrypt($request->new_pass) // Hash the password
                'password' => Hash::make($request->new_pass) // Hash the password
            ]);

            return redirect()->route('account.index')->with('success', 'Account updated successfully');
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
