@component('admin.layouts.content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">

    <div class="card-body">
        <div class="d-flex justify-content-between">
          <h4 class="card-title">Role List</h4>
            <div>
              <a class="nav-link btn btn-sm btn-success  " href="{{ route('create-role') }}">+ Create  Role</a>
            </div>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> # </th>
              <th>Role name </th>
              <th>Role label</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $roles as $role)
            <tr>
                <input type="hidden" class="delete_val_id" value="{{ $role->id }}">
                <td> {{  $role->id }} </td>
                <td> {{ $role->name }}</td>
                <td> {{ $role->label }}</td>
                <td>
                 <a href="{{ route('edit-role',$role->id ) }}" class="btn btn-sm btn-info">Edit</a>
                 <button type="submit" class="btn btn-sm btn-danger deletebtn" ">Delete</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endcomponent
