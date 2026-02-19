@extends('layouts.dashboard._auth')
@section('title', __('Reset Password'))
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <h3>{{__('Reset Password')}}</h3>
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>{{__('Enter your new password')}}</span>
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <form class="form-horizontal" action="{{ route('admin.password.reset.post') }}" method="POST" novalidate>
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $email }}">
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control input-lg" id="user-password" name="password"
                                                       placeholder="{{__('Your Password')}}"
                                                       required>
                                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror

                                                <div class="form-control-position">
                                                    <i class="la la-lock">
                                                    </i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                                    class="ft-unlock"></i> {{__('Reset Password')}}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
