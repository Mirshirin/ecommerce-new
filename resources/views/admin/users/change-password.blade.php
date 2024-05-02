
@component('admin.layouts.content')
    <div class="card-body">
        <h4 class="card-title">Edit User</h4>

        <form id="frm" class="form-inline" method="POST" action="{{ route('update-password') }}">
            @csrf
            
            <label class="sr-only-visible" for="name">old password</label>
            <input type="password" class="form-control mb-2 mr-sm-2"  id="old_password" name="old_password"  value="{{ old('password', $user->password) }}" style= "background-color:white !important; color: black;" >
           
            <label class="sr-only-visible" for="password">New Password</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="new_password" name="new_password" placeholder="Enter new Password "  style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" for="password_confirmation">Password Confirmation</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="password_confirmation" name="password_confirmation"  placeholder="Enter Password confirmation" style= "background-color:white !important; color: black;" >
            
           
            
            <button type="submit" class="btn btn-primary mb-2">Update Password</button>
            
        </form>
    </div>

@endcomponent
