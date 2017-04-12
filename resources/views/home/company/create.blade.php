@extends('home.common.layout')
@section('title', '公司')
@section('content')
    <div id="myCard">
        @section('breadcrumb')
            {!! Breadcrumbs::render('company.create') !!}
        @show
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="">注册公司</a>
            </li>
        </ul>
        <div class="myCard-content  main-cont">
            <p class="phone-show">注册公司</p>
            <form action="{{ url('company') }}" class="lt" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="input rt">
                    <div>
                        <span><i class="" style="color: red;">*</i>公司名称:</span>
                        <input type="text" name="Company[name]" value="{{ old('Company.name') }}" placeholder="公司名称">
                    </div>
                    @if ($errors->has('Company.name'))
                        <p class="pass-error show">{{ $errors->first('Company.name') }}</p>
                    @endif

                    <div>
                        <span><i class="" style="color: red;">*</i>显示名称:</span>
                        <input type="text" name="Company[display_name]" value="{{ old('Company.display_name') }}" placeholder="显示名称">
                    </div>
                    @if ($errors->has('Company.display_name'))
                        <p class="pass-error show">{{ $errors->first('Company.display_name') }}</p>
                    @endif

                    <div class="file">
                        <span>图标: </span>
                        <input type="file" name="Company[logo]">
                    </div>
                    @if ($errors->has('Company.logo'))
                        <p class="pass-error show">{{ $errors->first('Company.logo') }}</p>
                    @endif

                    <div>
                        <span>地址: </span>
                        <input type="text" name="Company[address]" value="{{ old('Company.address') }}" placeholder="">
                    </div>
                    @if ($errors->has('Company.address'))
                        <p class="pass-error show">{{ $errors->first('Company.address') }}</p>
                    @endif

                    <div>
                        <span>邮箱: </span>
                        <input type="email" name="Company[email]" value="{{ old('Company.email') }}" placeholder="">
                    </div>
                    @if ($errors->has('Company.email'))
                        <p class="pass-error show">{{ $errors->first('Company.email') }}</p>
                    @endif

                    <div>
                        <span>联系电话: </span>
                        <input type="tel" name="Company[telephone]" value="{{ old('Company.telephone') }}" placeholder="">
                    </div>
                    @if ($errors->has('Company.telephone'))
                        <p class="pass-error show">{{ $errors->first('Company.telephone') }}</p>
                    @endif

                    <div class="user-j">
                        <span>公司简介: </span>
                        <textarea name="Company[description]" id="">{{ old('Company.description') }}</textarea>
                    </div>
                    @if ($errors->has('Company.description'))
                        <p class="pass-error show">{{ $errors->first('Company.description') }}</p>
                    @endif

                    <input type="submit" value="确认">
                    <input type="button" value="返回" id="back" data-url="{{ url('company') }}">
                </div>

            </form>
        </div>
    </div>
@stop

@section('javascript')
    <script>
    </script>
@stop
