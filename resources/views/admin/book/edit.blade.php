@extends('layout.admin')
@section('title', '読書記録の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>読書記録編集</h2>
                <form action="{{ route('admin.book.update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="タイトルを入力">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20" placeholder="本文を入力">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">著者</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="author" value="{{ old('author') }}" placeholder="著者を入力">
                        </div>
                        <label class="col-md-2">出版社</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="publisher" value="{{ old('publisher') }}" placeholder="出版社を入力">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-2">ページ数</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="page" value="{{ old('page') }}" placeholder="ページ数を入力">
                        </div>
                        <label class="col-md-2">満足度</label>
                        <div class="col-md-3">
                            <select class="form-control" name="satisfaction">
                                <option value="">満足度を選択</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>    
                      <div class="form-group row">
                          <label class="col-md-2">ジャンル</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="genre" value="{{ old('genre') }}" placeholder="ジャンルを入力">
                        </div>
                        <label class="col-md-2">短編集</label>
                        <div class="col-md-3">
                            <select class="form-control" name="shortstory">
                                <option value="">〇か✕を選択</option>
                                <option value="0">✕</option>
                                <option value="1">〇</option>
                            </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-md-2">引用句</label>
                        <div class="col-md-10">
                     　　　　<textarea class="form-control" name="quote" rows="2" placeholder="引用句を入力">{{ old('quote') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="book_image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="book_image">
                            <div class="form-text text-info">
                                設定中: {{ $book_form->image }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $book_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                    <label class="col-md-2">公開するかどうか</label>
                        <div class="col-md-3">
                            <select class="form-control" name="open">
                                <option value="1">公開</option>
                                <option value="2">下書き</option>
                            </select>
                        </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2 style="font-size: 18px;">編集履歴</h2>
                        <style>
                          .list-group-item {
                          background-color: #008000;
                          color: #ffffff;
                            }
                        </style>
                        <ul class="list-group">
                            @if ($book_form->histories != NULL)
                                @foreach ($book_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection