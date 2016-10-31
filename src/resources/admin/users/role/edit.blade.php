@extends('admin::layouts.layouts')

@section('title', '编辑角色')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">编辑角色</h3>
    </div>
    @include('admin::users.role.form', [
        'url' => route('admin.users.role.postEdit', ['id' => $role->id]),
        'role' => $role
    ])
</div>

@endsection