<x-guest-layout>

<div class="overlay-layout">  </div>
    
    <div class="img-layout" style="background-image: url('{{asset('form/images/background.jpg')}}'); background-size: cover; background-repeat: no-repeat; background-position: center center;height:760px">
        <section class="ftco-section">
            <div class="container">
                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </x-slot>
                <!-- Validation Errors -->
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Đổi mật khẩu</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                        <form class="signin-form" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Địa chỉ email -->
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Mời nhập Email"
                                id="email" name="email" :value="old('email', $request->email)" required autofocus>
                                @error('email')
                                    <span class="invali-feedback" role="alert" style="color: red">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Mật khẩu -->
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" placeholder="Mời nhập mật khẩu" 
                                name="password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('password')
                                    <span class="invali-feedback" role="alert" style="color: red">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password_confirmation" type="password" class="form-control" placeholder="Nhập lại mật khẩu" 
                                name="password_confirmation" required >
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('password_confirmation')
                                    <span class="invali-feedback" role="alert" style="color: red">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="form-control btn btn-primary submit px-3">
                                    {{ __('Đổi mật khẩu') }}
                                </x-primary-button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
