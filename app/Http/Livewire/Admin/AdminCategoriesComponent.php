<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;


class AdminCategoriesComponent extends Component
{
    public $category_id;
    use WithPagination;

    public function deleteCategory(){
        $category= Category::find($this->category_id);
        $category->delete();
        session()->flash('message', 'Catagory has been deleted Successfully!');
    }

    public function render()
    {
        $Categories = Category::orderBy('name','ASC')->paginate(5);
        return view('livewire.admin.admin-categories-component',['categories'=>$Categories]);
    }
}
