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

    public function validateInput(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'alpha', 'max:255'],
            'last_name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'email', 'unique:customusers'],
            'password' => ['required', 'string', 'min:8' , 'max:255']
        ]);

        if ($validator->fails()) {
            return false ;
        } else {
            return true ;
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
    public function store(Request $request)
    {

        if ($this->validateInput($request)) {
            try {
                // Attempt to create a new user
                CustomUser::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password), // Hash the password
                    'role_id' => 2  // By default registeration is for users
                ]);

                // Redirect on success
                return redirect()->route('account.index')->with('success', 'Registered Successfully');
            } catch (\Exception $e) {

                return redirect()->back()->with('error', 'Registration Failed');
            }
        } else {
            return redirect()->back()->with('error', 'Email already exists');
        }

    }

    // public function login(Request $request)
    // {
    //     $user = CustomUser::where('email', '=', $request->email);
    //     if($user){
    //         if($request->password == $user->password){
    //             return redirect()->route('account.home')->with('succes', 'Login Successful');
    //         }
    //         else {
    //             return redirect()->route('account.index')->with('error', 'Invalid Email Or Password');
    //         }
    //     } else {
    //         return redirect()->route('account.index')->with('error', 'Account Does Not Exist');
    //     }
    // }




    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user(); // Get the authenticated user
            Session::put('user_id', $user->id); // Store user_id in the session
            Session::put('user_name', $user->first_name); // Store user_name in the session

            if ($user->role_id == 2) {
                return redirect()->route('products.index')->with('success', 'Login Successful');
            } else if ($user->role_id == 1) {
                return redirect()->route('admin.index')->with('success', 'Login Successful');
            }
        } else {
            return redirect()->route('account.index')->with('error', 'Invalid Email Or Password');
        }
    }

    public function logout()
    {
        Auth::logout(); // Logout the currently authenticated user
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

        $oldhashed = Hash::make($request->password);

        if ($oldhashed == $user->password ) {
        // if (password_verify($request->password , $user->password)) {
            // Old password matches, update the user's information
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                // 'password' => $request->new_pass
                'password' => Hash::make($request->new_pass), // Hash the password
            ]);

            return redirect()->route('account.index')->with('success', 'Account updated successfully');
        } else {
            return redirect()->route('account.index')->with('error', 'Old Password does not match');
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
