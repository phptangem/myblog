<nav class="navbar navbar-default">
    <div class="container">
        <div class="nav-header">

            {{--Branding Image--}}
            <a href="{{ url('backend/login') }}" class="navbar-brand">
                {{ app_name() }}
            </a>
        </div>
        {{--<div class="collapse navbar-collapse" id="frontend-navbar-collapse">--}}

            {{--Left side of navbar--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li>{{ link_to_route('frontend.index',trans('navs.frontend.home')) }}</li>--}}
                {{--<li>{{ link_to_route('frontend.macros',trans('navs.frontend.macros')) }}</li>--}}
            {{--</ul>--}}

            {{--Right side of navbar--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}

                {{--@if(config('locale.status') && count(config('locale.languages')) > 1)--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                            {{--{{trans('menus.language-picker.language')}}--}}
                            {{--<span class="caret"></span>--}}
                        {{--</a>--}}

                        {{--@include('includes.partials.lang')--}}
                    {{--</li>--}}
                    {{--@endif--}}

                            {{--<!-- Authentication  Links-->--}}
                    {{--@if(Auth::guest())--}}
                        {{--<li>{{link_to('login', trans('navs.frontend.login'))}}</li>--}}
                        {{--<li>{{link_to('register', trans('navs.frontend.register'))}}</li>--}}
                    {{--@else--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li>{!! link_to_route('frontend.user.dashboard', trans('navs.frontend.dashboard')) !!}</li>--}}

                                {{--@if(access()->user()->canChangePassword())--}}
                                    {{--<li>{!! link_to_route('auth.password.change', trans('navs.frontend.user.change_password')) !!}</li>--}}
                                {{--@endif--}}

                                {{--@permission('view-backend')--}}
                                {{--<li>{!! link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) !!}</li>--}}
                                {{--@endauth--}}

                                {{--<li>{!! link_to_route('auth.logout', trans('navs.general.logout')) !!}</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endif--}}

            {{--</ul>--}}
        {{--</div>--}}
    </div>
</nav>