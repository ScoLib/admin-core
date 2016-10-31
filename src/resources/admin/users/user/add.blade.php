@extends('admin::layouts.layouts')

@section('title', '新增用户')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">新增用户</h3>
    </div>
    @include('admin::users.user.form', ['url' => route('admin.users.user.postAdd')])
</div>

@endsection