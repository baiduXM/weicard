@extends('home.common.layout')
@section('title', '通讯录')
@section('content')
    <div id="myCard">
        <ul class="cont-nav rt">
            <li><a href="">我的通讯录 > </a></li>
            <li class="cont-nav-act"><a href="">通讯录</a></li>
        </ul>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="">我的通讯录</a>
            </li>
        </ul>
        <div class="myCard-content rt-main">
            <ul class="b-button">
                <li class="b-btn-bg"><a href=""><i class="iconFont">&#xe6d3;</i>批量删除</a></li>
                <li class="b-btn-bg" data-toggle="modal" data-target=".bs1"><a href="javascript:"><i class="iconFont">&#xe67d;</i>添加</a>
                </li>
                <li class="b-btn-bor b-sort-btn ">
                    <a href="javascript:">选择排序<i class="iconFont">&#xe618;</i></a>
                    <ul class="b-sort none">
                        <li><a href="">按名字排序</a></li>
                        <li><a href="">按职位排序</a></li>
                        <li><a href="">按部门排序</a></li>
                        <li><a href="">按入职时间排序</a></li>
                    </ul>
                </li>
                <li class="b-btn-bor"><a href="">查询字段<i class="iconFont">&#xe618;</i></a></li>
                <li class="b-search  ">
                    <form action="">
                        <input class="b-input b-form-bor" type="text" placeholder="请输入关键字">
                        <input class="b-ser-btn b-form-bg" type="submit" value="查找">
                    </form>
                </li>
            </ul>
            <table class="table b-table">
                <thead>
                <tr class="active">
                    <th class="b-phone-w"><input type="checkbox" id="box8"><label for="box8"><i class="iconFont">&#xe7de;</i></label>
                    </th>
                    <th class="b-phone-w2"><a href="">姓名</a></th>
                    <th class="b-phone-w2"><a href="">公司</a></th>
                    <th class="b-phone-w2"><a href="">电话</a></th>
                    <th class=" b-td-hide"><a href="">操作</a></th>
                    <th class=" b-td-show"><a href="javascript:"><i class="iconFont">&#xe652;</i></a></th>
                </tr>
                </thead>
                <tbody>
                @if(!count($cardcases))
                    <tr class="b-no-bor">
                        <td colspan="10" class="">无记录</td>
                    </tr>
                @else
                    @foreach($cardcases as $item)
                        <tr>
                            <td class="b-phone-w"><input type="checkbox" id="box7"><label for="box7"><i
                                            class="iconFont">&#xe7de;</i></label>
                            </td>
                            <td class="b-phone-w2">{{ $item->follower->name }}{{  $item->remark ? '('.$item->remark.')' : '' }}</td>
                            <td class="b-phone-w2">{{ $item->getFollowerType($item->follower_type) == 'u' ? '个人用户' : $item->follower->company->name }}</td>
                            <td class="b-phone-w2">{{ $item->getFollowerType($item->follower_type) == 'u' ? $item->follower->mobile : $item->follower->telephone }}</td>
                            {{--<td class="b-td-width">{{ $item->getFollowerType($item->follower_type) == 'user' ? : '' }}</td>--}}
                            <td class="b-td-icon b-td-hide">
                                <a href="javascript:;" data-toggle="modal" data-target=".bs2"><i
                                            class="iconFont">&#xe613;</i></a>
                                {{--<a href=""><i class="iconFont">&#xe632;</i></a>--}}
                                {{--<a href=""--}}
                                   {{--data-url="{{  url('cardcase/follow/'.$item->getFollowerType($item->follower_type).'-'.$item->follower_id) }}"><i--}}
                                            {{--class="iconFont">&#xe921;</i></a>--}}
                                {{--<a href="javascript:" data-toggle="modal" data-target=".bs3"><i--}}
                                {{--class="iconFont">&#xe6d3;</i></a>--}}
                            </td>
                            <td class=" b-td-show" id="b-td-show"><a href="javascript:"><i class="iconFont">&#xe621;</i></a>
                            </td>
                        </tr>
                        <tr class="td-icon-hide none">
                            <td id="look"><a href="address-phone-look.html"><i class="iconFont">&#xe613;</i></a></td>
                            <td><a href=""><i class="iconFont">&#xe632;</i></a></td>
                            <td><a href=""><i class="iconFont">&#xe921;</i></a></td>
                            <td><a href="javascript:" data-toggle="modal" data-target=".bs3"><i
                                            class="iconFont">&#xe6d3;</i></a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <p class="clickMore none"><a href="">点击查看更多 <i class="iconFont">&#xe652;</i></a></p>
            {!! $cardcases->render() !!}
        </div>
    </div>
@stop