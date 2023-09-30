<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * 担当者一覧
     */
    public function index()
    {
        // 担当者一覧取得
        $users = User::orderBy('id','asc')->paginate(10);

        return view('user.index',['users' => $users]);
    }
}
