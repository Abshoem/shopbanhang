<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     public function index(): View
     {
         // Lấy danh sách danh mục từ cơ sở dữ liệu
         $categories = Category::all();
     
         // Lấy danh sách sản phẩm từ cơ sở dữ liệu, phân trang 6 sản phẩm mỗi trang
         $products = Product::latest()->paginate(6);
     
        //  $user = Auth::user();
     
        //  $orders = Order::where('email', $user->email)->latest()->paginate(6);
     
        //  $order_count = Order::where('email', $user->email);
         
        //      // Tính tổng số đơn hàng của người dùng
        //      $cartCount = $order_count->count();

        $cartCount = 0;
         
     
         // Truyền cả products và categories vào View
         return view('products.index', compact('products', 'categories', 'cartCount'));
     }
     

    public function admin(): View
    {
        $products = Product::latest()->paginate(5);

        return view('products.admin', compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function showdetail2($id)
{
    $product = Product::findOrFail($id);
    return view('products.showdetail2', compact('product'));
}
public function buy($id)
{
    $product = Product::findOrFail($id);

    Order::create([
        'name' => $product->name,
        'price' => $product->price,
        'img' => $product->image,
        'order_time' => now(),
    ]);

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // Lấy phần mở rộng của file
            $filename = time() . '.' . $extension; // Tạo tên file duy nhất
            $file->move(public_path('uploads/product/'), $filename); // Lưu file vào thư mục
            $validated['image'] = 'uploads/product/' . $filename; // Lưu đường dẫn vào database
        }

        // Tạo sản phẩm với dữ liệu đã xác thực
        Product::create($validated);

        return redirect()->route('products.admin')
                         ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        // Kiểm tra và xử lý file ảnh khi cập nhật
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/product/'), $filename);
            $validated['image'] = 'uploads/product/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('products.admin')
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.admin')
                         ->with('success', 'Product deleted successfully.');
    }
    /**
     * Phần Category_id.
     */
    
}