<html>
<head>
    <meta name="_token" content="{{ csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title',app_name())</title>

    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'default description')">
    <meta name="author" content="@yield('meta_author', 'Tangem')">
    @yield('meta')

            <!-- Styles -->
    @yield('before_styles_end')
    {!! Html::style(elixir('css/backend.css')) !!}
    @yield('after_styles_end')

            <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
</head>
<body id="app-layout">

<nav class="navbar navbar-default">
    <div class="container">
        <div class="nav-header">

            {{--Branding Image--}}
            <a href="{{ url('backend/login') }}" class="navbar-brand">
                {{ app_name() }}
            </a>
        </div>
    </div>
</nav>

<div class="container">
    @include('backend.includes.partials.messages')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

                <div class="panel-heading">{{ trans('labels.backend.passwords.reset_password_box_title') }}</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'backend/password/reset', 'class' => 'form-horizontal']) !!}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        {!! Form::label('email', trans('validation.attributes.backend.email'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.email')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('password', trans('validation.attributes.backend.password'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.password')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        {!! Form::label('password_confirmation', trans('validation.attributes.backend.password_confirmation'), ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.password_confirmation')]) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit(trans('labels.backend.passwords.reset_password_button'), ['class' => 'btn btn-primary']) !!}
                        </div><!--col-md-6-->
                    </div><!--form-group-->

                    {!! Form::close() !!}

                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
</div>

<!-- Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
{{--<script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>--}}
{{--{!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}--}}

@yield('before-scripts-end')
{{--{!! Html::script(elixir('js/backend.js')) !!}--}}
@yield('after-scripts-end')

</body>
</html>