<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request): View
{
    $search = $request->input('search'); // Lấy giá trị tìm kiếm từ request (có thể là email hoặc name)

    // Tìm kiếm các đơn hàng dựa trên email hoặc tên
    $orders = Order::query()
        ->when($search, function ($query) use ($search) {
            $query->where('email', 'like', "%$search%") // Tìm kiếm theo email
                  ->orWhere('name', 'like', "%$search%"); // Tìm kiếm theo tên
        })
        ->latest() // Sắp xếp theo thời gian (mới nhất trước)
        ->paginate(6); // Phân trang với 6 đơn hàng mỗi trang

    // Lấy danh sách các danh mục
    $categories = Category::latest()->paginate(6); // Giả sử bạn có Category model

    return view('categories.index', compact('orders', 'categories')); // Trả về view với danh sách đơn hàng và danh mục
}


    public function showProducts($categoryId): View
{
    // Lấy danh mục theo ID
    $category = Category::findOrFail($categoryId);
    
    // Lấy các sản phẩm thuộc danh mục này
    $products = Product::where('category_id', $categoryId)->paginate(6);
    
    return view('categories.showProducts', compact('category', 'products'));
}





    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category/'), $filename);
            $validated['image'] = 'uploads/category/' . $filename;
        }

        // Tạo danh mục mới
        $category = Category::create($validated);

        return redirect()->route('categories.index')
                     ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh khi cập nhật
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category/'), $filename);
            $validated['image'] = 'uploads/category/' . $filename;
        }

        // Cập nhật danh mục
        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

    public function createProduct($categoryId): View
{
    // Truyền category_id vào view
    return view('products.create', compact('categoryId'));
}

    /**
     * Store a newly created product in storage.
     */
    public function storeProduct(Request $request, $categoryId): RedirectResponse
    {
        $category = Category::findOrFail($categoryId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/products/'), $filename);
            $validated['image'] = 'uploads/products/' . $filename;
        }

        $validated['category_id'] = $categoryId;

        Product::create($validated);

        return redirect()->route('categories.showProducts', $categoryId)
            ->with('success', 'Product created successfully.');
    }
}