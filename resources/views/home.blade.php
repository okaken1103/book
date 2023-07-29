@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                
                <a href="{{ route('admin.book.index') }}" class="btn btn-primary">
                    読書記録一覧画面へ
                </a>
                
            </div>
        </div>
    </div>
</div>
@endsection
