<x-guest-layout >
    
    {{-- <div class="overlay-layout">  </div> --}}
    <div class="img-layout" style="background-image: url('{{asset('form/images/background1.jpg')}}'); background-size: cover; background-repeat: no-repeat; background-position: center center;height:760px">
        <section class="ftco-section">
            <div class="container">
                <!-- Validation Errors -->
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Đăng nhập</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <!-- <h3 class="mb-4 text-center">Have an account?</h3> -->
                            <form class="signin-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <!-- Địa chỉ email -->
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Mời nhập email"
                                    id="email" type="email" name="email" :value="old('email')" required autofocus>
                                    @error('email')
                                    <span class="invali-feedback" role="alert" style="color: red">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Mật khẩu -->
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" placeholder="Mời nhập mật khẩu" 
                                    name="password" required autocomplete="current-password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password hidepass-js"></span>
                                    @error('password')
                                    <span class="invali-feedback" role="alert" style="color: red">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Đăng nhập -->
                                <div class="form-group">
                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="form-control btn btn-primary submit px-3">
                                            {{ __('Đăng nhập') }}
                                        </x-primary-button>

                                        <!-- Ghi nhớ tài khoản -->
                                        <div class="form-group d-md-flex">
                                            <div class="w-50">
                                                <label class="checkbox-wrap checkbox-primary">{{ __('Ghi nhớ tài khoản') }}<input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            @if (Route::has('password.request'))
                                            <div class="w-50 text-md-right">
                                                <a style="color: #fff" href="{{ route('password.request') }}">
                                                    {{ __('Quên mật khẩu?') }}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('register') }}" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span>Bạn chưa có tài khoản ?</a>
                            </form>
                            <p class="w-100 text-center">&mdash; Hoặc đăng nhập với &mdash;</p>
                            <div class="social d-flex text-center">
                                <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
                                <a href="{{route('google.redirect')}}" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Google</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        const passField = document.querySelector("input");
           const showBtnList = document.querySelectorAll(".hidepass-js");
           showBtnList.forEach(showBtn => {
            showBtn.onclick = (()=>{
                let passField = showBtn.previousElementSibling;
                if(passField.type === "password"){
                    passField.type = "text";
                }else{
                    passField.type = "password";
                }
            });
        });
    </script>
</x-guest-layout>
