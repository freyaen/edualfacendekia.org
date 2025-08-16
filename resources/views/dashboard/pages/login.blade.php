@include('dashboard.layouts.head')

<!-- login page start-->
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo" href="{{route('index')}}"><img width="100"
                                src="{{asset('assets/img/logo/logo.png')}}" class="img-fluid for-light"
                                alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('dashboard.login.submit') }}">
                            @csrf
                            <h4>Masuk Admin Panel</h4>
                            <p>Masukkan email & password anda</p>

                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" name="email" required
                                    placeholder="admin@example.com">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required
                                        placeholder="*********">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="text-end mt-3">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Masuk</button>
                                </div>
                            </div>

                            @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                {{ $errors->first() }}
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.layouts.tail')
