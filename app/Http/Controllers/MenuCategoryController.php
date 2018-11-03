<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    public function __construct()
    {
        //做权限验证
        $this->middleware('auth', [
            //除了那些方法生效
            'except' => ['index'],

            //只对那些方法生效
            //'only'=>[]
        ]);

    }

    //添加
    public function create()
    {
        return view('menucategory.add');

    }

    public function store(Request $request)
    {
        $menucategory = MenuCategory::where([['shop_id', '=', Auth::user()->shop_id], ['is_selected', '=', 1]])->get();

        if ($request->is_selected==1) {
            if (count($menucategory)) {
            DB::update('update menu_categories set is_selected=?',[0]);
               // return back()->with('danger', '已有默认菜单,不能重复添加')->withInput();
            }

        }elseif($request->is_selected==null){
            $request->is_selected=0;
        }


        $this->validate($request, [
            'name' => 'required',
            'type_accumulation' => 'required',
//            'shop_id'=>'required',
            'description' => 'required',
        ], [
            'name.required' => '名称不能为空',
            'type_accumulation.required' => '菜品编号不能为空',
//            'shop_id.required'=>'所属商家ID不能为空',
            'description.required' => '描述不能为空',
        ]);
        MenuCategory::create([
            'name' => $request->name,
            'type_accumulation' => $request->type_accumulation,
            'shop_id' => Auth::user()->shop_id,
            'description' => $request->description,
            'is_selected' => $request->is_selected ?? 1,
        ]);
        return redirect('menucategorys')->with('success', '添加成功');

    }

    //列表
    public function index()
    {
        $menucategorys = MenuCategory::where('shop_id',Auth::user()->shop_id)->paginate(3);
        return view('menucategory.index', compact('menucategorys'));

    }

    //修改
    public function edit(menucategory $menucategory)
    {
        return view('menucategory.edit', compact('menucategory', 'shops'));

    }

    public function update(menucategory $menucategory, Request $request)
    {
        //dd($request->is_selected);
        $menucate = MenuCategory::where([['shop_id', '=', Auth::user()->shop_id], ['is_selected', '=', 1]])->get();
        if ($request->is_selected == 1) {
            if (count($menucate)) {
                DB::update('update menu_categories set is_selected=?',[0]);
                //return back()->with('danger', '已有默认菜单,不能重复添加')->withInput();
            }
        }elseif($request->is_selectes==null){
            $request->is_selected=0;
        }
        $this->validate($request, [
            'name' => 'required',
            'type_accumulation' => 'required',
//            'shop_id'=>'required',
            'description' => 'required',
        ], [
            'name.required' => '名称不能为空',
            'type_accumulation.required' => '菜品编号不能为空',
//            'shop_id.required'=>'所属商家ID不能为空',
            'description.required' => '描述不能为空',
        ]);
        $menucategory->update([
            'name' => $request->name,
            'type_accumulation' => $request->type_accumulation,
            'shop_id' => Auth::user()->shop_id,
            'description' => $request->description,
            'is_selected' => $request->is_selected ?? $menucategory->is_selected,
        ]);
        return redirect('menucategorys')->with('success', '修改成功');

    }

    //删除
    public function destroy(menucategory $menucategory)
    {
        $menu = Menu::where('category_id', '=', $menucategory->id)->first();
        if ($menu) {
            return back()->with('danger', '菜品分类里还有菜品,不能删除')->withInput();
        }
        $menucategory->delete();
        return redirect('menucategorys')->with('success', '删除成功');

    }
    //查看菜品

    public function list(Request $request)
    {
        $td=MenuCategory::where([['shop_id','=',Auth::user()->shop_id],['is_selected','=',1]])->first();

        if($td){
            $id=$_GET['id'] ?? $td->id;
        }

        if(!$td){
            $id=$_GET['id'] ?? 1;
        }
        //dump($request->input());
        $articles=MenuCategory::where('shop_id','=',Auth::user()->shop_id)->get();
        // dd($articles);



        if($request->keys!=null&&$request->section!=null&&$request->sections!=null){
            $menus=Menu::where([['category_id',$id],['shop_id',Auth::user()->shop_id],['goods_name','like',"%$request->keys%"]])->whereBetween('goods_price',[$request->section,$request->sections])->get();
        }elseif($request->section==0&&$request->sections==null){
            $menus=Menu::where([['category_id',$id],['shop_id',Auth::user()->shop_id],['goods_name','like',"%$request->keys%"]])->get();
        }elseif($request->keys==0){
            $menus=Menu::where([['category_id',$id],['shop_id',Auth::user()->shop_id],])->whereBetween('goods_price',[$request->section,$request->sections])->get();
            //echo 3;
        }elseif($request->keys==null&&$request->section==null&&$request->sections==null){

$menus=Menu::where([['category_id','=',$id],['category_id',$id]])->get();


        }
        return view('menucategory.list',compact('articles','menus','id'));

    }

}