<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        //做权限验证
        $this->middleware('auth',[
            //除了那些方法生效
            'except'=>['index'],

            //只对那些方法生效
            //'only'=>[]
        ]);

    }
    //添加
    public function create()
    {
        $shops = DB::table('shop__categories')->get();
        return view('shop.add', compact('shops'));

    }

    public function store(Request $request)
    {

        //dd($request->input());
        //dd($request->shop_category_id);
        $this->validate($request, [
            'shop_category_id' => 'required',
            'shop_name' => 'required',
            'shop_img' => 'required',
            'shop_rating' => 'required',
            'start_send' => 'required',
            'send_cost' => 'required',
            'notice' => 'required',
            'discount' => 'required',
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
        ],
            [//自定义错误提示
                'shop_category_id.required' => '店铺分类ID不能为空',
                'shop_name.required' => '名称不能为空',
                'shop_img.required' => '店铺图片不能为空',
                'shop_rating.required' => '评分不能为空',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送费不能为空',
                'notice.required' => '店公告不能为空',
                'discount.required' => '优惠信息不能为空',
                'name.required'=>'名称不可以是空哦',
                'email.required'=>'邮箱不可以是空哦',
                'email.email'=>'邮箱格式不对',
                'password.required'=>'密码不可以是空哦',
                'password.min'=>'密码不可以少于4位数',
            ]);


        DB::beginTransaction();
        try {
            $shop = Shop::create([
                'shop_category_id' => $request->shop_category_id,
                'shop_name' => $request->shop_name,
                'shop_img' => $request->shop_img,
                'shop_rating' => $request->shop_rating,
                'brand' => $request->brand ?? 0,
                'on_time' => $request->on_time ?? 0,
                'fengniao' => $request->fengniao ?? 0,
                'bao' => $request->bao ?? 0,
                'piao' => $request->piao ?? 0,
                'zhun' => $request->zhun ?? 0,
                'start_send' => $request->start_send,
                'send_cost' => $request->send_cost,
                'notice' => $request->notice,
                'discount' => $request->discount,
                'status' => 0,
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'remember_token' => str_random(50),
                'status' => 0,
                'shop_id' => $shop->id,

            ]);
            //dd($shop);
            DB::commit();//提交事务
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e);
            //事务回滚
            //dd($shop);

        }
        return redirect('shops')->with('success', '添加成功');
    }
    public function index(){
        $shops=Shop::all();
        return view('shop.index',compact('shops'));
    }
    //改密码
    public function pwd(){
        return view('shop.pwd');
    }
    public function save(Request $request){
        $this->validate($request,[
            'olpwd'=>'required',
            'pwd'=>'required|min:4',
        ],[
                'olpwd.required'=>'旧密码不能为空',
                'pwd.required'=>'密码不能为空',
                'pwd.min'=>'密码不能少于4位数',
            ]
        );
        //dd(1);
        //验证原密码
        //dd(Auth::user()->getAuthPassword());
        //dd($request->olpwd,$request->pwd);
        if(!Hash::check($request->olpwd, Auth::user()->getAuthPassword())){
            return back()->with('danger','原密码错误，请重新填写')->withInput();
        }
        if($request->repwd!=$request->pwd){
            return back()->with('danger','确认密码必须与新密码相同')->withInput();
        }

        //更新进数据库
        Auth::user()->update(['password'=>bcrypt($request->pwd)]);
        session()->flash('success','修改个人密码成功');
        return redirect('shops');
    }
    //上传图片
    public function upload(Request $request){
        $path=$request->file('file')->store('public/shop');
        return ['path'=>Storage::url($path)];
    }
    
    
}