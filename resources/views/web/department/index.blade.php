@extends('web.common.layout')
@section('title', '公司')
@section('content')
    <div id="myCard">
        @section('breadcrumb')
            {!! Breadcrumbs::render('company.department') !!}
        @show
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="">公司部门</a>
            </li>
        </ul>
        <div class="myCard-content rt-main">
            <p class="phone-show add-yg">公司部门</p>
            <ul class="b-button">
                <li class="b-btn-bg"><a href="javascript:" data-toggle="modal" data-target="#modal-department-add"><i
                                class="iconFont">&#xe67d;</i>添加</a>
                </li>
            </ul>
            <table class="table b-table" id="tableList">
                <thead>
                <tr class="active">
                    <th class="b-phone-w"><input type="checkbox" id="boxAll"><label for="boxAll" class="iconFont"><i>&#xe7de;</i></label>
                    </th>
                    <th class="b-phone-w2"><a href="">部门</a></th>
                    <th><a href="">部门交接人</a></th>
                    <th class="b-phone-w2"><a href="">人数</a></th>
                    <th class=" b-td-show"><a href="javascript:"><i class="iconFont">&#xe652;</i></a></th>
                    <th class=" b-td-hide"><a href="">操作</a></th>
                </tr>
                </thead>
                <tbody>
                @if(count($departments))
                    @foreach($departments as $item)
                        <tr>
                            <td class="b-phone-w"><input type="checkbox" id="{{ $item->id }}">
                                <label for="{{ $item->id }}" class="iconFont"><i>&#xe7de;</i></label>
                            </td>
                            <td class="b-phone-w2">{{ $item->name }}</td>
                            <td>{{ $item->owner->nickname or '' }}</td>
                            <td class="b-td-width">{{ count($item->employees) }}</td>
                            <td class="b-td-icon b-td-hide">
                                <a href="" data-toggle="modal" data-target="#modal-department-edit"
                                   data-url="{{ url('company/department/'.$item->id) }}" class="operate-edit"><i
                                            class="iconFont">&#xe632;</i></a>
                                <a href="javascript:void(0);" data-toggle="modal" data-target=".bs3"
                                   class="operate-delete"
                                   data-url="{{ url('company/department/'.$item->id) }}">
                                    <i class="iconFont">&#xe6d3;</i></a>
                            </td>
                            <td class=" b-td-show" id="b-td-show"><a href="javascript:"><i class="iconFont">&#xe621;</i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="b-no-bor">
                        <td colspan="12">还未创建部门</td>
                    </tr>
                @endif


                </tbody>
            </table>
            <p class="clickMore none"><a href="">点击查看更多 <i class="iconFont">&#xe652;</i></a></p>
            {!! $departments->render() !!}
        </div>
    </div>
@stop
@section('modal-extend')
    <!-- 职位 - 添加modal -->
    <div class="modal fade" id="modal-department-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal1">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">添加部门</h4>
                </div>
                <form action="{{ url('company/department') }}" method="post" class="form-create"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="modal-address">
                            <p>
                                <span>名称 : </span>
                                <input type="text" name="Department[name]" placeholder=""
                                       value="{{ old('Department.name') ? old('Department.name') : '' }}">
                                <span class="error-name" style="color: red;"></span>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary operate-create">确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 职位 - 编辑modal -->
    <div class="modal fade" id="modal-department-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal1">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">编辑部门</h4>
                </div>
                <form action="{{ url('company/department') }}" method="put" class="form-update"
                      enctype="multipart/form-data">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="modal-address">
                            <p>
                                <span>部门名称 : </span>
                                <input type="text" name="Department[name]" placeholder="" class="info-name"
                                       value="{{ old('Department.name') ? old('Department.name') : '' }}">
                                <span class="error-name" style="color: red;"></span>
                            </p>
                            <p>
                                <span>部门交接人 : </span>
                                <select name="Department[employee_id]" id="employee_id"
                                        class="info-employee_id"></select>
                                <span class="error-employee_id" style="color: red;"></span>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary operate-update">确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(function () {
            /* 操作 - 编辑 */
            $(".operate-edit").unbind('click').on('click', function () {
                var _url  = $(this).data("url");
                var _form = $(".form-update");
                _form.attr("action", _url);
                $.get(_url, function (data) {
                    _form.find('.info-name').val(data.name);
                    var str = '<option value="0">选择人员</option>';
                    if (data.employees.length > 0) { // 加载员工
                        $.each(data.employees, function (k, v) {
                            str += '<option value="' + v.id + '">' + v.nickname + '</option>';
                        });
                    } else {
                        str = '<option value="0">部门内暂无员工</option>';
                    }
                    _form.find('#employee_id').html(str);
                    if (data.owner) { // 选中主管
                        _form.find('#employee_id').val(data.owner.id);
                    }
                });
            });

            $(".operate-update").unbind('click').on('click', function () {
                var _url      = $('.form-update').attr('action');
                var _method   = $(this).parents('form').attr('method') ? $('.form-update').attr('method') : 'post';
                var _formData = $(this).parents('form').serializeArray();
//                var _formData = $('.form-update').serialize();
//                var _formData = new FormData($('.form-update')[0]);
                console.log(_formData);
                $("[class^='error-']").addClass('hidden');
                $.ajax({
                    url: _url,
                    type: _method,
//                    cache: false,
//                    contentType: false,
//                    processData: false,
                    data: _formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (json) {
                        console.log('success-update')
                        console.log(json)
                        $('.hintModal').modal('show');
                        $('.hintModal .modal-body').text(json.msg);
                        $('.hintModal .after-operate').text();
                    },
                    error: function (json) {
                        console.log('error-update')
                        console.log(json)
                        var errors = json.responseJSON;
                        showError(errors);
                        return false;
                    }
                });
            });
        });
    </script>
@stop