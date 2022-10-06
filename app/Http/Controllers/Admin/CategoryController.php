<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = config('colors');

        $category = new Category();
        return view('admin.categories.create',compact('category','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'string|unique:categories',
            'color' => 'string',
        ],[
            'label.string' => 'Il label deve essere una stringa',
            'color.string' => 'Il colore deve essere una delle scelte impostate'
        ]); 

        $data = $request->all();

        $category = new Category();

        $category->fill($data);

        $category->save();

        return redirect()->route('admin.categories.show',compact('category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $colors = config('colors');

        return view('admin.categories.create',compact('category','colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'label' => ['string',Rule::unique('categories')->ignore($category->id)],
            'color' => 'string',
        ],[
            'label.string' => 'Il label deve essere una stringa',
            'color.string' => 'Il colore deve essere una delle scelte impostate'
        ]); 

        $data = $request->all();

        $category->update($data);

        return redirect()->route('admin.categories.show',compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
