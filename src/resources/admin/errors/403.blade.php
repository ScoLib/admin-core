<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @section('title', '403')
    @include('admin::layouts.partials.htmlheader')
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="locked text-center" style="font-size: 42px;">
        <i class="fa fa-lock"></i>
    </div>

    <div class="lockscreen-logo">
        <b>403</b>
    </div>

    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        对不起，你没有权限操作这个页面
    </div>
    <div class="text-center">
        <a href="{{ $previousUrl }}" class="btn btn-success btn-block">返回</a>
    </div>
</div>
<!-- /.center -->

@include('admin::layouts.partials.script')
</body>
</html>
