<!-- form start -->
<form method="post" id="form-role" action="{{ $url }}" class="form-horizontal">
    <div class="box-body">
        <div class="form-group margin-l-0 margin-r-0">
            <label for="name" class="col-sm-3 control-label">名称</label>
            <div class="col-sm-6">
                <input type="text" data-toggle="tooltip"
                       data-original-title="必须唯一" name="name"
                       class="form-control" id="name"
                       placeholder="角色名称" value="{{ $role->name or '' }}">
            </div>
        </div>
        <div class="form-group margin-l-0 margin-r-0">
            <label for="display_name" class="col-sm-3 control-label">显示名称</label>
            <div class="col-sm-6">
                <input type="text" name="display_name" class="form-control"
                       id="display_name" placeholder="显示名称" value="{{ $role->display_name or '' }}">
            </div>
        </div>
        <div class="form-group margin-l-0 margin-r-0">
            <label class="col-sm-3 control-label">备注</label>
            <div class="col-sm-6">
                <textarea id="description" class="form-control" rows="3"
                          name="description">{{ $role->description or '' }}</textarea>
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

            $('#form-role').validate({
                rules: {
                    'name': {
                        required: true
                    },
                    'display_name': {
                        required: true
                    }
                },
                messages: {
                    'name': {
                        required: '{{ trans('admin.users.role_name_required') }}'
                    },
                    'display_name': {
                        required: '{{ trans('admin.users.role_display_name_required') }}'
                    }
                }
            });
        })
    </script>
@endsection