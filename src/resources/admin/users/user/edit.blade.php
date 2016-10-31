@extends('admin::layouts.layouts')

@section('title', '编辑用户')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">编辑用户</h3>
    </div>
    @include('admin::users.user.form', [
        'url' => route('admin.users.user.postEdit', ['uid' => $userInfo->uid]),
        'userInfo' => $userInfo
    ])
</div>

@endsection