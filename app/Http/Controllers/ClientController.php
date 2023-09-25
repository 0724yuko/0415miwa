<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
        /**
     * 顧客一覧
     */
    public function index()
    {
        // 顧客一覧取得
        $clients = Client::all();

        return view('client.index',['clients' => $clients]);
    }


        //一覧画面表示
        public function list(Request $request)
        {    
            $keyword = $request -> keyword;
            $query = Client::query();
            if($request->keyword != ""){
            $query = $query->where( 'name' , 'like' , '%' . $keyword .'%' );
            }
    
            $clients = $query ->orderBy('id', 'asc'); 
            return view('client.list',[
                'clients'=> $clients,
                'keyword' => $keyword
        ]);
        }
    

    /**
     * 顧客登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:200',
            ]);

            // 顧客登録
            Client::create([
                'name' => $request->name,
                'data' => $request->data,
            ]);

            return redirect('/clients');
        }

        return view('client.add');
    }


}
