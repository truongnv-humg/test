@extends("admin.layouts.app")
@section('body')
    <div class="row justify-content-md-center mt-5">
        <div class="col col-lg-5">
            <div class="card shadow border-0">
                <div class="card-header border-0">
                    <h3>{{ __('auth.login.title') }}</h3>
                </div>
                <div class="card-body border-0">
                    <form method="post" action="{{ route('login.action') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('auth.login.email') }}</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('auth.login.password') }}</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">{{ __('auth.login.remember') }}</label>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('auth.login.title') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
