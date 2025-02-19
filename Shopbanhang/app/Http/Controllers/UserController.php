<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    // Lấy danh sách người dùng
    public function index()
    {
        return UserResource::collection(User::all());
    }

    // Lấy chi tiết người dùng
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function store(Request $request)
{
    // Xác thực dữ liệu nhập vào (validation)
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        // Tạo người dùng mới và lưu vào cơ sở dữ liệu
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),  // Mã hóa mật khẩu
        ]);

        // Trả về tài nguyên người dùng đã được tạo
        return new UserResource($user);

    } catch (\Exception $e) {
        // Xử lý lỗi khi tạo người dùng
        return response()->json([
            'error' => 'Có lỗi xảy ra khi tạo người dùng',
            'message' => $e->getMessage()
        ], 500);
    }}
}