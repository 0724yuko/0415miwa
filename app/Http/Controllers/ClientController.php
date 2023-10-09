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
    // public function index()
    // {
    //     // 顧客一覧取得
    //     $clients = Client::orderBy('id','asc')->paginate(10);

    //     return view('client.index',['clients' => $clients]);
    // }


        //一覧画面表示
        public function index(Request $request)
        {    
            $keyword = $request -> input('keyword');//requestからキーワードを取得
            //クエリを構築
            $query = Client::query();
            if($keyword != ""){
                $query->where( 'name' , 'like' , '%' . $keyword .'%' );
            }
    
            //ソートはpaginateの前に設定する費用があります
            $query->orderBy('id','asc');
            //ページネーションを適用
            $clients = $query ->paginate(10)
            ->appends(['keyword' => $keyword]);
            return view('client.index',[
                'clients'=> $clients,
                'keyword' => $keyword
        ]);
        }
    

    /**
     * 顧客登録
     */
     public function add(Request $request)
     {
        return view('client.add');
     }

     //新規登録を保存
     public function store(Request $request)
     {
        $messages = [
            'name.max' => '200文字までです。',
            'data.max' => '500文字までです。',
        ];
        $request->validate([
            'name' => 'required|max:200',
            'data' => 'required|max:500'
        ],$messages);

             // 顧客登録
        $client = new Client;
        $client -> create([
            'name' => $request->name,
            'data' => $request->data,
        ]);

             return redirect('/clients');
     }
    //      return view('client.add');
    //  }


       // 該当IDの編集画面呼び出し

       public function clientcard(Request $request,$id)
       {
           $client = Client::find($id);
           return view('client.clientcard',['client' => $client]);
       } 

           // 削除処理
    public function delete($id)
    {
        Client::find($id)->delete();
        return redirect('/clients');
    }    

       // 編集画面を保存
       public function update(Request $request,$id)
       {
        $messages = [
            'name.max' => '200文字までです。',
            'data.max' => '500文字までです。',
           ];
   
           $request->validate([
            'name' => 'required|max:200',
            'data' => 'required|max:500',
        ],$messages);  
   
           $client = Client::find($id);
           $client->name = $request->name;
           $client->data = $request->data;
  
           $client->save();
           return redirect('/clients');
       }


}
