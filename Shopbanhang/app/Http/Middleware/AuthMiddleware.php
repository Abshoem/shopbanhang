<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
        }

        // Kiểm tra xem người dùng có phải là admin hay không
        $user = Auth::user();
        if ($user->email === 'admin@gmail.com') {
            return $next($request); // Nếu là admin, cho phép truy cập vào tất cả các route
        }

        // Kiểm tra nếu là những route yêu cầu admin (ví dụ: route quản lý sản phẩm, đơn hàng)
        $adminRoutes = [
            'orders.index', 
            'categories.create', 
            'categories.edit', 
            'categories.showProducts', 
            'categories.storeProduct',
            'categories.destroy',
            'categories.index', // Thêm route index của categories
            'categories.update', // Thêm route update của categories
            'products.create',
            'products.edit',
            'rate.showByEmail'
        ];

        // Nếu người dùng không phải admin và cố gắng truy cập vào những route yêu cầu admin
        if (in_array($request->route()->getName(), $adminRoutes)) {
            return abort(403, 'Unauthorized'); // Trả về lỗi 403 nếu không phải admin
        }

        // Cho phép truy cập vào các route khác
        return $next($request);
    }
}