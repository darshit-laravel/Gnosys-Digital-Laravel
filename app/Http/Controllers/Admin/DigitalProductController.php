<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DigitalProduct;
use App\Models\Category;
use App\Models\CustomField;
use Illuminate\Support\Str;

class DigitalProductController extends Controller
{

    /**
     * Display a listing of the digital products.
     */
    public function index(Request $request)
    {
        if (!auth('admin')->user()->hasPermission('products')) {
            return abort(403, 'Unauthorized action.');
        }

        $query = DigitalProduct::query();

        // Filter by category
        if ($request->category) {
            $query->byCategory($request->category);
        }

        // Search functionality
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->ordered()->paginate(10);
        $categories = Category::where('type', 'product')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        if (!auth('admin')->user()->hasPermission('products', 'create')) {
            return abort(403, 'Unauthorized action.');
        }

        $customfields = CustomField::query()->select([
            'id','custom_field_type_id','name','slug','module_type','params','options','status'
            ])
            ->where('module_type', 'product')
            ->where('status', 1)
            ->get();

        $categories = Category::where('type', 'product')->get();
        return view('admin.products.create', compact('categories', 'customfields'));
    }

    /**
     * Store a newly created digital product in storage.
     */
    public function store(Request $request)
    {
        if (!auth('admin')->user()->hasPermission('products', 'create')) {
            return abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'subcategory' => 'nullable|string',
            'image_url' => 'required|url',
            'badge' => 'nullable|string',
            'is_sale' => 'boolean',
            'original_price' => 'nullable|numeric|min:0',
            'product_id' => 'required|string|unique:digital_products,product_id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $product = DigitalProduct::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'category_id' => $request->category_id,
            'category' => Category::find($request->category_id)->name,
            'subcategory' => $request->subcategory,
            'image_url' => $request->image_url,
            'badge' => $request->badge,
            'is_sale' => $request->boolean('is_sale'),
            'original_price' => $request->original_price,
            'product_id' => $request->product_id,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Digital product created successfully!');
    }

    /**
     * Show the form for editing the specified digital product.
     */
    public function edit(DigitalProduct $product)
    {
        if (!auth('admin')->user()->hasPermission('products', 'edit')) {
            return abort(403, 'Unauthorized action.');
        }

        $categories = Category::where('type', 'product')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified digital product in storage.
     */
    public function update(Request $request, DigitalProduct $product)
    {
        if (!auth('admin')->user()->hasPermission('products', 'edit')) {
            return abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'subcategory' => 'nullable|string',
            'image_url' => 'required|url',
            'badge' => 'nullable|string',
            'is_sale' => 'boolean',
            'original_price' => 'nullable|numeric|min:0',
            'product_id' => 'required|string|unique:digital_products,product_id,' . $product->id,
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'category_id' => $request->category_id,
            'category' => Category::find($request->category_id)->name,
            'subcategory' => $request->subcategory,
            'image_url' => $request->image_url,
            'badge' => $request->badge,
            'is_sale' => $request->boolean('is_sale'),
            'original_price' => $request->original_price,
            'product_id' => $request->product_id,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Digital product updated successfully!');
    }

    /**
     * Remove the specified digital product from storage.
     */
    public function destroy(DigitalProduct $product)
    {
        if (!auth('admin')->user()->hasPermission('products', 'delete')) {
            return abort(403, 'Unauthorized action.');
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Digital product deleted successfully!');
    }

    /**
     * Toggle the active status of a digital product.
     */
    public function toggleStatus(DigitalProduct $product)
    {
        if (!auth('admin')->user()->hasPermission('products', 'edit')) {
            return abort(403, 'Unauthorized action.');
        }

        $product->update([
            'is_active' => !$product->is_active
        ]);

        return back()->with('success', 'Product status updated successfully!');
    }
}
