<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\categoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount(['products' => function ($query) {
            $query->withFilters(
                request()->input('categories', []),

            );
        }])
            ->get();

        return categoryResource::collection($categories);
    }

    /**
     */
    public function store(StoreCategoryRequest $request)
    {
        $product = category::create($request);
        $product->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = category::find($id);
        return categoryResource::make($product);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        category::find($id)->update($request->all);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        category::find($id)->destroy();
    }
}
