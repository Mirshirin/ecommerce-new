<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-users')->only(['allUsers']);
        $this->middleware('can:create-user')->only(['createUser','storeUser']); 
        $this->middleware('can:edit-user')->only(['editUser','updateUser']);  
        $this->middleware('can:delete-user')->only(['deleteUser']);
    }
    public function allUsers(){
        
        $users = User::paginate(7);    
         
       return view('admin.users.all-users',compact('users'));
    }
    public function createUser(){
        return view('admin.users.create-user');
    }
    public function storeUser(Request $request){
        $data =
            $request->validate([
                'name' => ['required','string','max:255'],
                'email' => ['required','string','email','unique:users','max:255'],
                'phone' => ['string','max:255'],
                'address' => ['string','max:255'],
                'password' => ['required','string','min:8','confirmed'],


            ]);
       
        $user= User::create($data);
        if ($request->has('verify'))
        {
            $user->markEmailAsVerified();
        }
      return redirect(route('all-users'))->with('message','user was stored');
    }
    public function editUser($id)
    {
       $user= User::find($id);
        return view('admin.users.edit-user')->with('user' , $user);
    }
    public function updateUser(Request $request, $id)
    {
        $user= User::find($id);
        $data =
            $request->validate([
                'name' => ['required','string','max:255'],
                'email' => ['required','string','email',Rule::unique('users')->ignore($user->id),'max:255'],
                'phone' => ['string','max:255'],
                'address' => ['string','max:255'],
            ]);
            if(! is_null($request->password)){
                
                $request->validate([ 
                    'password' => ['required','string','min:8','confirmed'],  
                ]);
                $data['password'] = $request->password;
            }       
            $user ->update($data);
//        session::flash('statuscose', 'success');
        if ($request->has('verify'))
        {
            $user->markEmailAsVerified();
        }
        return to_route('all-users')->with('message','user was updated.');
    }
    public function updatePassword(Request $request)
    {
      
        $data=$request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);       
         /// Match the old passwword
         if (!Hash::check($request->old_password,auth()->user()->password)){
            $notification= array(
                'message' => 'old password does not match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
         } 
         //update new password  
         User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
         ]) ; 
         $notification= array(
            'message' => 'password change successfully!',
            'alert-type' => 'success'
        );  
       // return back()->with($notification);

       return redirect('admin/dashboard');
      
    }

    public function changePassword()
        {
            $id=auth()->user()->id;
            $user=User::find($id);
        return view('admin.users.change-password',compact('user'));
    }
    public function deleteUser($id)
    {
        $user=User::find($id);
        
        $user->delete();
        return response()->json([ 'status' => 'User deleted successfully' ]);
    }
   
   
}
