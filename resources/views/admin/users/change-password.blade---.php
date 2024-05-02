
@component('admin.layouts.content')

    <div class="card-body">
        <h4 class="card-title">Edit User</h4>

        <form id="frm---" class="form-inline" method="POST" action="{{ route('update-password') }}" enctype="multipart/form-data">
            @csrf
            
            <label class="sr-only-visible" for="name">old password</label>
            <input type="password" class="form-control" >
            <label class="sr-only-visible" for="password">New Password</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="new_password" name="new_password" 
            placeholder="Enter new Password "  style= "background-color:white !important; color: black;" >
            <label class="sr-only-visible" >Password Confirmation</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="" name="password_confirmation"  
            placeholder="Enter Password confirmation" style= "background-color:white !important; color: black;" > 
            <button type="submit" class="btn btn-primary mb-2">Update Password</button>
            
        </form>
    </div>

@endcomponent
