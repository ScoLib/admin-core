<!-- form start -->
<form method="post" id="form-user" action="{{ $url }}" class="form-horizontal">
    <div class="box-body">
        <div class="form-group margin-l-0 margin-r-0">
            <label for="username" class="col-sm-3 control-label">用户名</label>
            <div class="col-sm-6">
                <input type="text" data-toggle="tooltip"
                       data-original-title="必须唯一，3-15位字母、数字组成" name="username"
                       class="form-control" id="username"
                       placeholder="用户名" value="{{ $userInfo->username or '' }}">
            </div>
        </div>
        <div class="form-group margin-l-0 margin-r-0">
            <label for="email" class="col-sm-3 control-label">邮箱</label>
            <div class="col-sm-6">
                <input type="email" data-toggle="tooltip"
                       data-original-title="必须唯一" name="email" class="form-control"
                       id="email" placeholder="邮箱" value="{{ $userInfo->email or '' }}">
            </div>
        </div>
        <div class="form-group margin-l-0 margin-r-0">
            <label for="password" class="col-sm-3 control-label">密码</label>
            <div class="col-sm-6">
                <input type="password" data-toggle="tooltip"
                       data-original-title="6-20位"  name="password" class="form-control" id="password" value="">
            </div>
        </div>
        <div class="form-group margin-l-0 margin-r-0">
            <label class="col-sm-3 control-label">角色</label>
            <div class="col-sm-6">
                @foreach ($roles as $role)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="role[]" value="{{ $role->id }}"{{ $userRoleIds->contains($role->id) ? ' checked' : '' }}>
                            {{ $role->display_name }}({{ $role->name }})
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">
            <i class="ace-icon fa fa-check bigger-110"></i>
            保存
        </button>
    </div>
</form>

@section('script')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $(function () {

            $('#form-user').validate({
                rules: {
                    'username': {
                        required: true,
                        rangelength: [3, 15],
                    },
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        {{ isset($userInfo) ? '' : 'required: true,' }}
                        rangelength: [6, 20]
                    },
                    'role[]': {
                        required: true
                    }
                },
                messages: {
                    'username': {
                        required: '{{ trans('admin.users.username_required') }}',
                        rangelength: '{{ trans('admin.users.username_rangelength') }}',
                    },
                    'email': {
                        required: '{{ trans('admin.users.email_required') }}',
                        email: '{{ trans('admin.users.email_format') }}'
                    },
                    'password': {
                        {{ isset($userInfo) ? '' : 'required: "' . trans('admin.users.password_required') . '",' }}
                        rangelength: '{{ trans('admin.users.password_rangelength') }}'
                    },
                    'role[]': {
                        required: '{{ trans('admin.users.role_required') }}'
                    }
                }
            });
        })
    </script>
@endsection