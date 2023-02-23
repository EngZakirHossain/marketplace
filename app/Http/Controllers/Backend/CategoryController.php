<?php

namespace App\Http\Controllers\Backend;

use App\Helper\Helpers;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $categories = Category::where(['position' => 0])->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $categories = Category::where(['position' => 0]);
        }
        $categories = $categories->latest()->paginate()->appends($query_param);
        return view('admin.pages.category.index', compact('categories', 'search'));
    }

    function sub_index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $categories = Category::with(['parent'])->where(['position' => 1])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $categories = Category::with(['parent'])->where(['position' => 1]);
        }
        $categories = $categories->latest()->paginate()->appends($query_param);
        return view('admin.pages.category.sub-index', compact('categories', 'search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $categories = Category::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.category.partials._table', compact('categories'))->render()
        ]);
    }

    function sub_sub_index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $categories = Category::with(['parent'])->where(['position' => 2])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $categories = Category::with(['parent'])->where(['position' => 2]);
        }
        $categories = $categories->latest()->paginate()->appends($query_param);
        return view('admin.pages.category.sub-sub-index',compact('categories', 'search'));
    }

    function sub_category_index()
    {
        return view('admin-views.category.index');
    }

    function sub_sub_category_index()
    {
        return view('admin-views.category.index');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        //uniqueness check
        $parent_id = $request->parent_id ?? 0;
        $all_category = Category::where('parent_id', $parent_id)->pluck('name');

        if ($request->name == $all_category) {
            Toastr::error(($request->parent_id == null ? 'Category' : 'Sub_category' . ' already exists!'));
            return back();
        }

        //image upload
        if (!empty($request->file('image'))) {
            $image_name = Helpers::upload('uploads/category/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }

        Category::updateOrCreate([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name),
            'parent_id'=> $request->parent_id == null ? 0 : $request->parent_id,
            'position'=> $request->position,
            'image'=> $image_name,
        ]);

        Toastr::success($request->parent_id == 0 ? 'Category Added Successfully!' : 'Sub Category Added Successfully!');
        return back();
    }

    public function edit($id)
    {
        $category = category::withoutGlobalScopes()->find($id);
        return view('admin.pages.category.edit', compact('category'));
    }

    public function status(Request $request)
    {
        $category = category::find($request->id);
        $category->status = $request->status;
        $category->save();
        Toastr::success($category->parent_id == 0 ? 'Category status updated!' : 'Sub Category status updated!');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
         $category->update([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name),
            'image'=> $request->has('image') ? Helpers::update('uploads/category/', $category->image, 'png', $request->file('image')) : $category->image,
        ]);
        Toastr::success($category->parent_id == 0 ? 'Category updated successfully!' : 'Sub Category updated successfully!');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $category = category::find($request->id);
        if (Storage::disk('public')->exists('uploads/category/' . $category['image'])) {
            Storage::disk('public')->delete('uploads/category/' . $category['image']);
        }
        if ($category->childes->count() == 0) {
            $category->delete();
            Toastr::success($category->parent_id == 0 ? 'Category removed!' : 'Sub Category removed!');
        } else {
            Toastr::warning($category->parent_id == 0 ? 'Remove subcategories first!' : 'Sub Remove subcategories first!');
        }
        return back();
    }
}
