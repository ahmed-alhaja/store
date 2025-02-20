<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); // Return Collection Object 

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        $category = Category::create($data);
        //PRG
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }
        // SELECT * FROM categories Where 'id' != $id 
        // (AND parent_id IS NULL OR parent_id = id)
        $parents = Category::where('id', '<>', $id) // return all tables except the table 
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);    // the parent != $id the present
            })
            // ->dd(); 
            ->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * 
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $category = Category::findOrFail($id);
        // deleted old image 
        $old_image = $category->image;
        // updated image 
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        $category->update($data);
        // $category->fill($request->all)->save();
        if ($old_image && $data['image']) {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        // Category::destroy($id);
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category deleted!');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file =  $request->file('image'); // Uploaded file object 
        $file->getClientOriginalName();
        $path = $file->store('uploads', 'public');
        return $path;
    }
}
 