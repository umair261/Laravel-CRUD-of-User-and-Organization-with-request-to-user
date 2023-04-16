<?php

namespace App\Http\Controllers;

use App\Models\org;
use App\Models\vendor;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
class UserController extends Controller
{

    function user_signup(Request $req){
        $req->validate([

            "email"=>"required|email|min:8|unique:users,email",
            "password"=>"required|min:8",
        ]);
        $new=new User;
        $new->name=$req->input('name');
        $new->father_name=$req->input('father_name');
        $new->email=$req->input('email');
        $new->password=$req->input('password');
        $new->address=$req->input('address');

        $new->created_at=now();

        $new->updated_at=now();

        $new->save();
        return response()->json(['message' => 'Successfully data entered user'],201);

    }
    function user_login(Request $request)
    {
        $request->validate([

            "email"=>"required|email",
            "password"=>"required",
        ]);
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
            if ($user ) {

                if ($password==$user->password){
                    $token=$user->createToken($user->email)->plainTextToken;


            return response()->json(['message' => 'Login successful','token'=>$token],200);
        }else{
                return response()->json([
                    'error' => 'Enter a valid password'
                ], 401);
            }

        } else {
            return response()->json([
                'error' => 'Invalid email '
            ], 401);
        }
    }
    function logout_user(Request $request){


        $user = $request->user();


        $user->tokens()->delete();

        return response()->json(['message' => 'Logout successful'], 200);

    }
    function user_delete($id) {

        $user = User::where('id',$id)->first();
        $user->delete();
        return response()->json(["message"=>"Deleted data"],201);

    }

       function user_update(Request $request, $id) {
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->name = $request->input('name');
            $user->father_name = $request->input('father_name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->address = $request->input('address');

            $user->save();
            return response()->json(['message' => 'User record updated successfully'], 201);
        } else {
            return response()->json(['message' => 'User record not found'], 404);
        }
    }

    function vendor_signup(Request $req){

            $req->validate([

                "email"=>"required|email|min:8|unique:vendors,email",
                "password"=>"required|min:8",
            ]);
            $new=new org();
            $new->name=$req->input('name');
            $new->father_name=$req->input('father_name');
            $new->email=$req->input('email');
            $new->password=$req->input('password');
            $new->address=$req->input('address');

            $new->created_at=now();

            $new->updated_at=now();

            $new->save();
            return response()->json(['message' => 'Successfully data entered user'],201);
    }
    function vendor_login(Request $req){
        $req->validate([

            "email"=>"required|email",
            "password"=>"required",
        ]);


        $email = $req->input('email');
        $password = $req->input('password');

        $user =org::where('email', $email)->first();
            if ($user) {
                if ($password==$user->password){
    ;
            return response()->json([
                'message' => 'Login successful']);}else{
                return response()->json([
                    'error' => 'Enter a valid password'
                ], 401);
            }

        } else {
            return response()->json([
                'error' => 'Invalid email '
            ], 401);
        }
    }
function vendor_delete($id) {

    $vendor = org::where('id',$id)->first();
    $vendor->delete();
    return response()->json(["message"=>"Deleted data"],201);

}
   function vendor_update(Request $request, $id) {
    $vendor = org::where('id', $id)->first();

    if ($vendor) {
        $vendor->name = $request->input('name');
        $vendor->father_name = $request->input('father_name');
        $vendor->email = $request->input('email');
        $vendor->password = $request->input('password');
        $vendor->address = $request->input('address');

        $vendor->save();
        return response()->json(['message' => 'Vendor record updated successfully'], 201);
    } else {
        return response()->json(['message' => 'Vendor record not found'], 404);
    }
}


}
