<?php

namespace App\Http\Livewire\category;

use App\Models\Blog;
use App\Models\Save;
use App\Models\Views;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

class ShowAllCategoryLivewire extends Component
{
    public function render()
    {
        return view('dashboard.category.show-all-category-livewire', [
            'category' => Category::all()
        ]);
    }
    public function deletecategory($idcategory)
    {
        $idcategory = Crypt::decrypt($idcategory);
        $findblog = Blog::with('category')->where('category_id', $idcategory)->get('id');
        if ($findblog != null) {
            $view = Views::where('destination', 'blog')->whereIn('destination_id', collect($findblog)->toArray())->truncate();
            $save = Save::where('destination', 'blog')->whereIn('destination_id', collect($findblog)->toArray())->truncate();
            Blog::destroy(collect($findblog)->toArray());
        }
        Category::destroy($idcategory);
    }
}
