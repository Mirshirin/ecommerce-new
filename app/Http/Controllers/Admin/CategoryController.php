<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    
    public function allCategories(){

        $categories = Category::query()

            ->orderBy('created_at','asc')
            ->paginate();

        return view('admin.categories.all-categories',['categories' =>   $categories ]);

    }
    public function createCategory(){
        return view('admin.categories.create-category');
    }

    public function storeCategory(Request $request){
        $data =
            $request->validate([
                'name' => ['required','string']

            ]);
        $data['name'] = $request->name;
        $category = Category::create($data);
      return to_route('all-categories' , $category)->with('message','category was created');
    }
  
    public function updateCategory(Request $request, $id)
    {
        $category= Category::find($id);

        $data = $request->validate([
            'name' => ['required', 'string']
        ]);

        $category ->update($data);
//        session::flash('statuscose', 'success');

        return to_route('all-categories', $category)->with('message', 'Note was updated');

    }
    public function editCategory($id)
    {

       $category= Category::find($id);

        return view('admin.categories.edit-category')->with('category' , $category);
    }
    public function deleteCategory($id)
    {
        $category=Category::find($id);
        
        $category->delete();
        return response()->json([ 'status' => 'Category deleted successfully' ]);
    }
}
