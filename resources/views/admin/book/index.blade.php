@extends('layout.admin')
@section('title', '登録済み読書記録の一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>読書記録一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.book.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.book.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">著者</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cond_author" value="{{ $cond_author }}">
                        </div>
                        <label class="col-md-2">出版社</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="cond_publisher" value="{{ $cond_publisher }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-books col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-red">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">タイトル</th>
                                <th width="10%">著者</th>
                                <th width="10%">出版社</th>
                                <th width="10%">満足度</th>
                                <th width="10%">ジャンル</th>
                                <th width="10%">短編集</th>
                                <th width="10%">操作</th>
                                <th width="10%">公開</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ Str::limit($book->title, 100) }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->satisfaction }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->shortstory }}</td>
                                <td><div><a href="{{ route('admin.book.edit', ['id' => $book->id]) }}">編集</a>
                                <div>
                                <a href="{{ route('admin.book.delete', ['id' => $book->id]) }}">削除</a>
                                </div>
                                </div></td>
                                <td>@if( $book->open ==1)
                                    公開
                                    @else
                                    下書き
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection