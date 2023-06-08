<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tp_question;
use App\Models\tp_category;
use App\Http\Requests\Admin\QuizRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
class QuizController extends Controller
{
    public function index(){
        $data['questions']= tp_question::
        join('tp_categories','tp_question.category_id','=','tp_categories.id_category')
        ->select('uuid_question','quiz','name_cate','tp_question.created_at')
        ->paginate(10);
        $data['categories_select'] = tp_category::select('id_category', 'name_cate', 'parent_id')
            ->where('status_cate', 1)
            ->get();
        $data['counter'] = 2;
        return view('admin.modules.quiz.index',$data);
    }

    public function status_quiz($uuid, $status)
    {   
        $statusChange = ($status == 0) ? 'Tắt' : 'Kích hoạt';

        tp_question::where('uuid_question', $uuid)->update(['status_quiz' => $status]);

        return redirect()
            ->back()
            ->with('success', ''.$statusChange.' câu hỏi thành công');
    }

 

    public function store(QuizRequest $request)
    {   
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $data['uuid_question'] = Str::uuid();
        $data['option'] = json_encode($data['option']);
        tp_question::insert($data);
     
        return redirect()
            ->back()
            ->with('success', 'Đã thêm câu hỏi thành công');
    }
    public function edit(string $uuid)
    {
        $quiz = tp_question::where('uuid_question', $uuid);
    
        if ($quiz->exists()) {
            $data['quiz'] = $quiz->first();
            $data['category_selected'] = tp_category::select('id_category', 'name_cate', 'parent_id')
                ->where('status_cate', 1)
                ->get();
            $data['counter'] = count(json_decode($data['quiz']->option));
            return view('admin.modules.quiz.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(QuizRequest $request, string $uuid)
    {   
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        tp_question::where('uuid_question', $uuid)->update($data);

       return redirect()->route('admin.quiz.index')->with('success', 'Cập nhật câu hỏi thành công.');

    }

    public function destroy(string $uuid)
    {
        $quiz = tp_question::where('uuid_question', $uuid)->first();

        if ($quiz) {
            $quiz->delete();
            return redirect()
                ->route('admin.quiz.index')
                ->with('success', 'Xóa người dùng thành công.');
        } else {
            abort(404);
        }
    }
}
