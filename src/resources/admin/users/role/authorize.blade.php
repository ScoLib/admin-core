@extends('admin::layouts.layouts')

@section('title', "角色授权[{$role->display_name}]")

@section('content')
    <div class="box" style="border-top: 0px;">
        <form action="{{ route('admin.users.role.postAuthorize', ['id' => $role->id]) }}">

        @foreach ($permList as $perm)
            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">
                        <label>
                            <input class="top-perm" type="checkbox" name="perms[]"
                                   value="{{ $perm->id }}" {{ $rolePermIds->contains($perm->id) ? 'checked' : '' }}>
                            {{ $perm->display_name }}
                        </label>
                    </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>

                </div>


                @if (!$perm->child->isEmpty())
                    <div class="box-body">

                    @foreach ($perm->child as $child)
                        <div class="col-sm-12 margin-offset-5">
                            <label>
                                <input class="top-perm sub-perm-{{ $child->pid }}"
                                       type="checkbox" name="perms[]"
                                       value="{{ $child->id }}" {{ $rolePermIds->contains($child->id) ? 'checked' : '' }}>
                                {{ $child->display_name }}
                            </label>
                        </div>
                        @if (!$child->child->isEmpty())
                            <div class="col-sm-12 col-xs-offset-1">

                                @foreach ($child->child as $subchild)

                                    <div class="col-sm-3">
                                        <label>
                                            <input class="sub-perm-{{ $child->pid }} sub-perm-{{ $subchild->pid }}"
                                                   type="checkbox" name="perms[]"
                                                   value="{{ $subchild->id }}" {{ $rolePermIds->contains($subchild->id) ? 'checked' : '' }}>
                                            {{ $subchild->display_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        @endif

                    @endforeach
                    </div>
                @endif
            </div>
        @endforeach

            <div class="box-footer" style="border-top: 0px;padding: 0px 10px 10px;">
                <button type="button" id="save-perms" class="btn btn-primary">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    保存
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('#save-perms').click(function () {
                $(this).ajaxPost();
            });

            $('.top-perm').click(function () {
                var permId = $(this).val();
                $('.sub-perm-' + permId).prop('checked', $(this).prop('checked'));
            });
        })
    </script>
@endsection
