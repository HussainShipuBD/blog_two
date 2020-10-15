<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Auth;   

class UserController extends Controller
{
    public function home(Request $request){
        return view('welcome');
    }

    public function index(Request $request){
        // return Auth::check();
        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }
        if (!Auth::check() && $request->path() == 'login') {
            return view('welcome');
        }

        // You're already logged in! if you're an admin..
        $user = Auth::user();
        // if ($user->role->isAdmin==0) {
        //      return redirect('/login');
        // }
        // if($request->path() == 'login'){
        //     return redirect('/');
        // }

        return view('welcome');
        // return $request->path(); 
    }


    // Registration
    public function registration(Request $request){
        $this->validate($request, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255'
        ]);
        
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    // Login
    public function login(Request $request){
        if((User::where('email', $request->email)->count())==0 && (User::where('phone', $request->email)->count())==0){
            return response()->json([
                'msg' => "Email or Phone  doesn't exist!",
            ],422);
        }

        // if((User::where([['email', $request->email],['isActive' , 0 ])->count())==0){
        //     return response()->json([
        //         'msg' => "Please Wait for the Admin Activation!",
        //     ],422);
        // }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
           return Auth::user();
        }else if (Auth::attempt(['phone' => $request->email, 'password' => $request->password ])) {
            return Auth::user();
        }else{
            return response()->json([
                'msg' => "Password doen't match!",
            ],422);
        }
    }


    // foget password email verified
    public function emailCheck(Request $request){
        $this->validate($request, [
            'email' => 'required'
        ]);
            
        if((User::where('email', $request->email)->count())==0){
            return response()->json([
                'msg' => "You does't have any account in this email!",
            ],422);
        }
        $code = rand(1000, 9999);
        $user = User::where('email', $request->email)->update(['resetToken' => $code]);
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'msg' => "Code gese check your email!",
            'user' => $user
            // 'email' => $request->email
        ],200);
    }

    // foget password code verified
    public function codeCheck(Request $request){
        // return $request;
        $this->validate($request, [
            'resetToken' => 'required'
        ]);
        
        // if((User::where('resetToken', $request->resetToken)->where('email', $request->email)->count())==0){
        if((User::where(['resetToken' => $request->resetToken, 'email' => $request->email])->count())==0){
            return response()->json([
                'msg' => "Code doen't match!",
            ],422);
        }
        
        return response()->json([
            'msg' => "Code match change your password!",
        ],200);
    }

    // foget password new password
    public function newPassword(Request $request){
        // return $request;
        $this->validate($request, [
            'password' => 'required|min:6'
        ]);

        // $data = [
        //     'password' => $request -> password
        // ];

        if ($request->password) {
            $password = bcrypt($request->password);
            //$data['password'] = $password; 
        };

        $user = User::where('email', $request->email)->update([
    		'password' => $password
        ]);
        
        // $user = User::where('id', $request->id)->update($data);
        return 'Reset password';
    }


    // Get user
    public function getUserData(Request $request){
        $user = Auth::user();
        return $user;
    }

    // edit profile
    public function editProfile(Request $request){
        $this->validate($request, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => "bail|required|string|max:255|email|unique:users,email,$request->id",
            'phone' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255'
        ]);
        
        User::where('id', $request->id)->update([
    		'firstName' => $request->firstName,
    		'lastName' => $request->lastName,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'country' => $request->country,
    		'city' => $request->city
        ]);
        return User::where('id', $request->id)->first();
    }

    // edit profile
    public function editPassword(Request $request){
        // $password = $request->oldPassword;
        $this->validate($request, [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6'
        ]);

        // if(!$request->oldPassword || strlen($request->oldPassword) < 6){
        //     return 'Invalid Request!';
        // }
        
        $user = Auth::user();
        
        $data['password'] = $request->oldPassword;

        $check = Hash::check($data['password'], Auth::user()->getAuthPassword());

        if($check){
            $newPassword = bcrypt($request->newPassword);
            return User::where(['id'=> $user->id])->update([
                'password' => $newPassword
            ]);
        }
        else {
            return response()->json([
                'message' => "Your Password doesn't match!",
            ], 403);
        }

        // if ($request->oldPassword) {
        //     $oldPassword = bcrypt($request->oldPassword);
        //     //$data['password'] = $password; 
        // };

        // $oldPassword = Hash::make($request['oldPassword']);

        // return $oldPassword;
        // // if((User::where('resetToken', $request->resetToken)->where('email', $request->email)->count())==0){
        // if((User::where(['password' => $oldPassword, 'id'=> $user->id])->count())==0){
        //     return response()->json([
        //         'msg' => "Password doen't match!",
        //     ],422);
        // }

        return User::where('id', $request->id)->first();
    }


    // Image upload
    public function upload(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png'
        ]);

        $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'),$picName);
        return $picName;
    }

    // image delete
    public function deleteImage(Request $request) {
        $fileName = $request->imageName;
        $this->deleteFileFromServer($fileName);
        return;
    }

    public function deleteFileFromServer($fileName) {
        $filePath = public_path() . $fileName;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }
}
