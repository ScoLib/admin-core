@extends('admin::layouts.layouts')

@section('title', '站点设置')

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">站点设置</h3>
        </div>
        <!-- form start -->
        <form method="post" id="form-config" action="{{ route('admin.system.site.save') }}"
              class="form-horizontal">
            <div class="box-body">
                <div class="form-group margin-l-0 margin-r-0">
                    <label for="site_name" class="col-sm-3 control-label">网站名称</label>
                    <div class="col-sm-6">
                        <input type="text" data-toggle="tooltip"
                               data-original-title="在前台顶部欢迎信息等位置显示" name="configs[site_name]"
                               class="form-control" id="site_name"
                               value="{{ $configs['site_name'] }}">
                    </div>
                </div>

                <div class="form-group margin-l-0 margin-r-0">
                    <label for="icp_number" class="col-sm-3 control-label">ICP证书号</label>
                    <div class="col-sm-6">
                        <input type="text" data-toggle="tooltip" data-original-title="前台页面底部显示"
                               name="configs[icp_number]"
                               class="form-control tooltips" id="icp_number"
                               value="{{ $configs['icp_number'] }}">
                    </div>
                </div>

                <div class="form-group margin-l-0 margin-r-0">
                    <label for="statistics_code" class="col-sm-3 control-label">第三方统计代码</label>
                    <div class="col-sm-6">
                        <textarea id="statistics_code" data-toggle="tooltip"
                                  data-original-title="前台页面底部显示" class="form-control" rows="3"
                                  name="configs[statistics_code]">{{ $configs['statistics_code'] }}</textarea>
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
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    <script>
        $(function () {
            $('#form-config').validate({

                rules: {
                    'configs[site_name]': {
                        required: true
                    }
                },
                messages: {
                    'configs[site_name]': {
                        required: '{{ trans('admin.system.site_name_required') }}'
                    }
                }
            });

        });
    </script>
@endsection