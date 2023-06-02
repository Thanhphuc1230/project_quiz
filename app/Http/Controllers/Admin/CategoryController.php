<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tp_category;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function index(){
        $data['categories']= tp_category::select('uuid_category','name_cate', 'status_cate', 'created_at')->paginate(10);
        $data['category_selected'] = tp_category::select('id_category', 'name_cate')->where('parent_id', 1)->get();

        return view('admin.modules.category.index',$data);
    }

    public function store(CategoryRequest $request)
    {
        
        $category = [
            'name_cate' => $request->name_cate,
            'uuid_category' =>  Str::uuid(),
            'status_cate' => $request->status_cate,
            'parent_id' => $request->parent_id,
            'created_at' => Carbon::now(), 
        ];
        tp_category::create($category);
        
        return redirect()->back()->with('success', 'Thêm chủ đề thành công');
    }

    public function status_categories($uuid,$status){
      
        tp_category::where('uuid_category',$uuid)->update(['status_cate'=>$status]);

        return redirect()->back()->with('success', 'Kích hoạt sản phẩm thành công');
    }
    public function edit(string $uuid)
    {   
        $category =tp_category::where('uuid_category', $uuid);
        
        if ($category->exists()) {
            $data['category'] = $category->first();
            $data['category_selected']= tp_category::all();
            return view('admin.modules.category.edit',$data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $uuid)
    {   
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        tp_category::where('uuid_category', $uuid)->update($data);

       return redirect()->route('admin.categories.index')->with('success', 'Cập nhật chủ đề thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {   
        $category = tp_category::where('uuid_category', $uuid);

        if ($category->exists()) {
            $category->delete();
            return back()->with('success', 'Xóa chủ đề thành công.');
        } else {
            abort(404);
        }
    }
}
