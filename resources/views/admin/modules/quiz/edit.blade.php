@extends('admin.master')
@section('content')
@section('module', 'Quiz')
@section('action', 'Edit')
@include('admin.partials.error')
<form action="{{ route('admin.quiz.update', ['uuid' => $quiz->uuid_question]) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <a href="{{ route('admin.categories.index') }}"> <i class="ti-arrow-left"
                                            style="font-size: 25px"></i></a>
                                    <h3 class="m-0">Quiz Edit</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <form>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Thuộc môn</h6>
                                    <select class="form-select" name="category_id">
                                        @foreach ($category_selected as $category_option)
                                            <option value="{{ $category_option->id_category }}"
                                                {{ old('category_id', $quiz->category_id) == $category_option->id_category ? 'selected' : '' }}>
                                                {{ $category_option->name_cate }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Câu hỏi</h4>
                                    <textarea type="text" name="quiz" class="form-control">{{ old('quiz',$quiz->quiz) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Đáp án A</h4>
                                    <textarea type="text" name="option_a" class="form-control">{{ old('option_a',$quiz->option_a) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Đáp án B</h4>
                                    <textarea type="text" name="option_b" class="form-control">{{ old('option_b',$quiz->option_b) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Đáp án C</h4>
                                    <textarea type="text" name="option_c" class="form-control">{{ old('option_c',$quiz->option_c) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Đáp án D</h4>
                                    <textarea type="text" name="option_d" class="form-control">{{ old('option_d',$quiz->option_d) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <h4 class="card-subtitle mb-2">Giải thích</h4>
                                    <textarea type="text" name="explain" class="form-control">{{ old('explain',$quiz->explain) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Đáp án đúng</h6>
                                    <select class="form-select" name="answers">
                                        <option value="a" {{ $quiz->answers == 'a' ? 'selected' : '' }}>A</option>
                                        <option value="b" {{ $quiz->answers == 'b' ? 'selected' : '' }}>B</option>
                                        <option value="c" {{ $quiz->answers == 'c' ? 'selected' : '' }}>C</option>
                                        <option value="d" {{ $quiz->answers == 'd' ? 'selected' : '' }}>D</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2">Trạng thái</h6>
                                    <select class="form-select" name="status_quiz">
                                        <option selected="" value="1"
                                            {{ old('status', $quiz->status_quiz) == 1 ? 'selected' : '' }}>Hiện
                                        </option>
                                        <option value="0"
                                            {{ old('status', $quiz->status_quiz) == 0 ? 'selected' : '' }}>Ẩn
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
