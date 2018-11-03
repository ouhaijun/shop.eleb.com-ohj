<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
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
        $shops=Shop::all();
        $menucategorys=MenuCategory::where('shop_id',Auth::user()->shop_id)->get();
        return view('menu.add',compact('shops','menucategorys'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'rating'=>'required',

            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'month_sales'=>'required',
            'rating_count'=>'required',
            'tips'=>'required',
            'satisfy_count'=>'required',
            'satisfy_rate'=>'required',
            'goods_img'=>'required',
        ],[
            'goods_name.required'=>'名称不能为空',
            'rating.required'=>'评分不能为空',

            'category_id.required'=>'所属分类ID不能为空',
            'goods_price.required'=>'价格不能为空',
            'description.required'=>'描述不能为空',
            'month_sales.required'=>'月销量不能为空',
            'rating_count.required'=>'评分数量不能为空',
            'tips.required'=>'提示信息不能为空',
            'satisfy_count.required'=>'满意度数量不能为空',
            'satisfy_rate.required'=>'满意度评分不能为空',
            'goods_img.required'=>'商品图片不能为空',

        ]);

        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>Auth::user()->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$request->month_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'goods_img'=>$request->goods_img,
            'status'=>$request->status ?? 0,
        ]);
        return redirect('menus')->with('success','添加成功');

    }
    //列表
    public function index()
    {
        $menus=Menu::where('shop_id',Auth::user()->shop_id)->paginate(3);
        return view('menu.index',compact('menus'));

    }
    //修改
    public function edit(menu $menu)
    {
        $shops=Shop::all();
        $menucategorys=MenuCategory::all();
        return view('menu.edit',compact('menu','shops','menucategorys'));

    }

    public function update(menu $menu,Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required',
            'rating'=>'required',

            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'month_sales'=>'required',
            'rating_count'=>'required',
            'tips'=>'required',
            'satisfy_count'=>'required',
            'satisfy_rate'=>'required',
            'goods_img'=>'required',
        ],[
            'goods_name.required'=>'名称不能为空',
            'rating.required'=>'评分不能为空',

            'category_id.required'=>'所属分类ID不能为空',
            'goods_price.required'=>'价格不能为空',
            'description.required'=>'描述不能为空',
            'month_sales.required'=>'月销量不能为空',
            'rating_count.required'=>'评分数量不能为空',
            'tips.required'=>'提示信息不能为空',
            'satisfy_count.required'=>'满意度数量不能为空',
            'satisfy_rate.required'=>'满意度评分不能为空',
            'goods_img.required'=>'商品图片不能为空',

        ]);

        $menu->update([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>$request->shop_id,
            'category_id'=>Auth::user()->shop_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$request->month_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'goods_img'=>$request->goods_img,
            'status'=>$request->status ?? 0,
        ]);
        return redirect('menus')->with('success','修改成功');
    }
    //删除
    public function destroy(menu $menu)
    {
        $menu->delete();
        return redirect('menus')->with('success','删除成功');

    }

   /* public function list()
    {
        //dd(11);
        //$menus=Menu::all();
        $id=$_GET['id'];
        $articles=Menu::where('shop_id','=',Auth::user()->id)->get();
        //dd($articles);
        $menus=Menu::where('category_id','=',$id)->get();
        return view('menu.list',compact('articles','menus'));

    }*/

    public function upload(Request $request){
        $path=$request->file('file')->store('public/menu');
        return ['path'=>Storage::url($path)];
    }
}
