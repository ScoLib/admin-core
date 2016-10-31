@extends('admin::layouts.layouts')

@section('title', '用户管理')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">搜索</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-angle-down"></i></button>
                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"
                        data-toggle="tooltip" title="关闭">
                    <i class="fa fa-times"></i></button>--}}
            </div>
        </div>
        <div class="box-body">
            <form class="form-inline">
                <div class="form-group">
                    <label for="search-uid">用户UID</label>
                    <input type="text" name="uid" class="form-control" id="search-uid"
                           placeholder="用户UID" value="{{ request('uid') }}">
                </div>
                <div class="form-group">
                    <label for="search-username">用户名</label>
                    <input type="text" name="username" class="form-control" id="search-username"
                           placeholder="用户名" value="{{ request('username') }}">
                </div>
                <div class="form-group">
                    <label for="search-email">邮箱</label>
                    <input type="text" name="email" class="form-control" id="search-email"
                           placeholder="邮箱" value="{{ request('email') }}">
                </div>
                <div class="form-group">
                    <label for="search-role">角色</label>
                    <select class="form-control" name="role">
                        <option value="0">选择角色</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"{{ $role->id == request('role') ? 'selected' : '' }}>{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">用户列表</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin.users.user.add') }}" class="btn btn-default btn-xs"><i
                            class="fa fa-plus"></i></a>
                <button class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button>
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th><input class="check-all" title="全选" type="checkbox"></th>
                    <th>UID</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>创建时间</th>
                    <th>角色</th>
                    <th class="col-sm-2">操作</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td><input type="checkbox" value="{{ $user->uid }}"></td>
                        <td>{{ $user->uid }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                {{ $role->display_name }}
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.users.user.edit', ['uid' => $user->uid]) }}"
                               class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                            <a class="btn btn-danger btn-xs ajax-get" href="{{ route('admin.users.user.delete', ['uid' => $user->uid]) }}" data-confirm="确定要删除？">
                                <i class="fa fa-trash-o"></i> 删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->

        <div class="box-footer clearfix">
            {{ $users->links('admin::layouts.partials.pagination') }}
        </div>

    </div>
@endsection
