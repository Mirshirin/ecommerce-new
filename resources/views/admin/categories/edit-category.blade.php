@component('admin.layouts.content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Category</h4>

        <form id="frm" class="form-inline" method="POST" action="{{ route('update-category',$category->id) }}">
            @csrf
            @method('patch')
<<<<<<< HEAD
            <label class="sr-only-visible" for="inlineFormInputName2">Category Name</label>
=======
            <label class="sr-only" for="inlineFormInputName2">Category Name</label>
>>>>>>> c9d01357ac4e174344611ce183590d0ce02866eb
            <input type="text" class="form-control mb-2 mr-sm-2" name="name" value="{{ old('name',$category->name) }}" placeholder="Enter category name" style= "background-color:white !important; color: black;">
            <br>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>
</div>
</div>
@endcomponent

