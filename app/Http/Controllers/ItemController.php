<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 対応一覧
     */
    public function index()
    {
        // 対応一覧取得
        // $items = Item::all();
        $items =Item::select([
            'items.*',
            'users.name as handleuser_name',
            'clients.name as client_name'
          ])->join('clients','items.client_id','=','clients.id')
        //   ->join('users','items.user_id','=','users.id')
          ->join('users','items.handleuser_id','=','users.id')
          ->get();

        // select * from items join on items.user_id = users.id
        // select * from items join on items.client_id = clients.id
// dump($items);
        return view('item.index', compact('items'));
    }

    /**
     * 新規対応登録画面表示
     */
    public function add(Request $request)
    {
        // // POSTリクエストのとき
        // if ($request->isMethod('post')) {
        //     // バリデーション
        //     $this->validate($request, [
        //         'name' => 'required|max:500',
        //     ]);

        //     // 対応登録
        //     Item::create([
        //         'client_id' => $client_id,
        //         'user_id' => $user_id,
        //         'handleuser_id' => $handleuser_id,
        //         'makeitem_at' => $makeitem_at,
        //         'handle_at' => $handle_at,
        //         'name' => $request->name,
        //         'remark' => $remark,
        //         'status' => $status,
        //         'comp_at' => $comp_at,
        //     ]);

        //     return redirect('/items');
        // }

        return view('item.add');
    }


    //新規登録を保存
    public function store(Request $request)
    {      
        $messages = [
            'name.max' => '500文字までです。',
            'remark.max' => '500文字までです。',
            // 'detail.unique' => '重複しています。', 
        ];
        $request->validate([
            'client_id' => 'required',
            'user_id' => 'required',
            'handleuser_id' => 'required',
            'makeitem_at' => 'required|date',
            'handle_at' => 'required|date',
            'name' => 'required|max:500',
            'remark' => 'nullable|max:500',
            'status' => 'nullable',
            'comp_at' => 'nullable|date',
        ],$messages);

        $item = new Item;
        $item -> create([
            'client_id' => $request -> client_id,
            'user_id' =>  $request -> user_id,
            'handleuser_id' =>  $request -> handleuser_id,
            'makeitem_at' =>  $request -> makeitem_at,
            'handle_at' =>  $request -> handle_at,
            'name' =>  $request -> name,
            'remark' => $request -> remark,
            'status' =>  $request -> status,
            'comp_at' =>  $request -> comp_at,
        ]);

        return redirect('/items');
    }






    //該当顧客IDの対応一覧を表示
    // public function clientitem(Request $request,$id)
    // {
    //     $client =Item::select([
    //         'items.*',
    //         'users.name as user_name',
    //         'clients.name as client_name'
    //       ])->join('clients','items.client_id','=','clients.id')
    //       ->join('users','items.user_id','=','users.id')
    //       ->where('clients.id','=',$id)
    //       ->orderBy('items.handle_at','desc')
    //       ->get();
    //     // $query = Item::query();

    //     $id = Client::find($id);
    //     // return view('item/index',['client' => $client]);
    //     return view('item.clientitem');
    // }

       // 該当IDの編集画面呼び出し

       public function itemcard(Request $request,$id)
       {
        //    $item = Item::find($id);

           $item =Item::select([
            'items.*',
            'users.name as handleuser_name',
            'clients.name as client_name'
          ])->join('clients','items.client_id','=','clients.id')
        //   ->join('users','items.user_id','=','users.id')
          ->join('users','items.handleuser_id','=','users.id')
          ->where('items.id',$id)->first();

    //     'users.name as handleuser_name',
    //     'clients.name as client_name'
    //   ])->join('clients','items.client_id','=','clients.id')
    // //   ->join('users','items.user_id','=','users.id')
    //   ->join('users','items.handleuser_id','=','users.id')
    //   ->get();
           return view('item.itemcard',['item' => $item]);
       } 
    
    
       // 編集画面を保存
       public function update(Request $request,$id)
       {
        $messages = [
            'name.max' => '500文字までです。',
            'remark.max' => '500文字までです。',
           ];
   
           $request->validate([
            'name' => 'required|max:500',
            'remark' => 'nullable|max:500',
            'status' => 'nullable',
            'comp_at' => 'nullable|date',
        ],$messages);  
   
           $item = Item::find($id);
           $item->name = $request->name;
           $item->remark = $request->remark;
           $item->status = $request->status;
           $item->comp_at= $request->comp_at;
   
           $item->save();
           return redirect('/items');
       }

    // 担当者該当IDの対応一覧画面呼び出し

    public function useritem(Request $request,$id)
    {
        $items =Item::select([
        'items.*',
        'users.name as handleuser_name',
        'clients.name as client_name'
        ])->join('clients','items.client_id','=','clients.id')
    //   ->join('users','items.user_id','=','users.id')
        ->join('users','items.handleuser_id','=','users.id')
        ->where('items.handleuser_id',$id)
        ->get();
        $handleuser_name = isset($items[0]) ? $items[0]->handleuser_name : '';


        return view('item.useritem',['items' => $items,'handleuser_name' => $handleuser_name]);
    } 
       
    // 顧客該当IDの対応一覧画面呼び出し

    public function clientitems(Request $request,$id)
    {
        $items =Item::select([
        'items.*',
        'users.name as handleuser_name',
        'clients.name as client_name'
        ])->join('clients','items.client_id','=','clients.id')
    //   ->join('users','items.user_id','=','users.id')
        ->join('users','items.handleuser_id','=','users.id')
        ->where('items.handleuser_id',$id)
        ->get();
        $client_name = isset($items[0]) ? $items[0]->client_name : '';


        return view('item.clientitems',['items' => $items,'client_name' => $client_name]);
    } 
}

