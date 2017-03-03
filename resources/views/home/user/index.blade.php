@extends('home.common.layout')
@section('title', '用户')
@section('content')
    <div class="side-right wow bounceInRight animated">
        <div class="mess">
            <span>账号：
                <input name="name" type="text" class="inputt" value="{{ $user->name }}"
                       onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <span>邮箱：
                <input name="email" type="text" class="inputt" value="{{ $user->email }}"
                       onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <span>电话：
                <input name="mobile" type="text" class="inputt" value="{{ $user->mobile }}"
                       onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <span>头像：
                <img src="{{ asset($user->avatar) }}"/>
                <a href="javascript:;" class="file"><input type="file" class="logoimg" value="" disabled="disabled">上传图片</a>
            </span>
            <span>性别：
                <input name="sex" type="text" class="inputt" value="{{ $user->sex }}" onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <span>年龄：
                <input name="age" type="text" class="inputt" value="{{ $user->age }}" onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <span>昵称：
                <input name="nickname" type="text" class="inputt" value="{{ $user->nickname }}"
                       onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <span>个人简介：
                <input name="description" type="text" class="inputt" value="{{ $user->description }}"
                       onfocus="ChangeStyle_hb(this,1,1)"
                       onblur="ChangeStyle_hb(this,2,1)" disabled="true">
            </span>
            <div class="inp">
                <a href="{{ url('user/'.$user->id.'/edit') }}"><input type="submit" class="sub" value="编辑"></a>
            </div>
        </div>
    </div>
@stop