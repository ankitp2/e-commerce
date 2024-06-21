<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Address;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required'
        ]);
        if ($request->file('profile_pic') !== null) {
            $image = $request->file('profile_pic')->store('images/profile_image', 'public');
        } else {
            $image = 'profile_image/pp3.avif';
        }
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->profile_pic = $image;
        $data->save();
        return redirect('signup');
    }
    public function check(Request $request)
    {
        // $request->validate([
        //     'g-recaptcha-response' => 'required|recaptcha',
        //     // Add your other form validation rules here
        // ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if ($request->email == 'admin@chetu.com' && $request->password == 'admin@123') {
                return redirect()->route('admin.home');
            } else {
                return view('index');
            }
        } else {
            return redirect('signup')->with('success', 'Invalid Credentials.');
        }
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return view('index');
    }
    public function showAdmin()
    {
        return view('admin.userdetails', [
            'users' => DB::table('users')->paginate(5)
        ]);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.user')->with('alert', 'User Removed successfully!');
    }
    public function profile()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $address = DB::table('addresses')->where('user_id', $user_id)->get();
        return view('userprofile', compact('user', 'address'));
    }
    public function pass_update(Request $request, $id)
    {
        $user = User::find($id);

        if (password_verify($request->password, $user->password)) {
            if ($request->npassword == $request->cpassword) {
                $user->password = password_hash($request->cpassword, PASSWORD_DEFAULT);
                $user->save();
                return redirect()->back()->with('success', 'Password Changed Successfully.');
            } else {
                return redirect()->back()->with('danger', 'Password not Matching.');
            }
        } else {
            return redirect()->back()->with('danger', 'Enter correct Password');
        }
    }
    public function userupdate($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'User Details Updated Successfully.');
    }
    public function profile_pic(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $image = $request->file('file')->store('images/profile_image', 'public');
        $user->profile_pic = $image;
        $user->save();
        return redirect()->back()->with('success', 'Profile Pic changed successfully.');
    }
    public function exportCSV(Request $request)
    {
        $filename = 'users_data.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID','Name', 'Email','Time of Joining']);
            User::chunk(25, function ($users) use ($handle) {
                foreach ($users as $user) {
                    $data = [
                        isset($user->id)? $user->id : '',
                        isset($user->name)? $user->name : '',
                        isset($user->email)? $user->email : '',
                        isset($user->created_at)? $user->created_at : '',
                    ];
                    fputcsv($handle, $data);
                }
            });
            fclose($handle);
        }, 200, $headers);
    }

}
