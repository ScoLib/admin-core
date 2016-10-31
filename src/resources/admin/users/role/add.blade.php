@extends('admin::layouts.layouts')

@section('title', '新增角色')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">新增角色</h3>
    </div>
    @include('admin::users.role.form', ['url' => route('admin.users.role.postAdd')])
</div>

@endsection