<x-guest-layout >
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
                        <div class="mb-4 text-sm text-gray-600" style="color: aliceblue">
                            {{ __('Đây là một khu vực an toàn của ứng dụng. Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.') }}
                        </div>
                        <h2 class="heading-section">Xác nhận mật khẩu</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <!-- <h3 class="mb-4 text-center">Have an account?</h3> -->
                            <form class="signin-form" method="POST" action="{{ route('password.confirm') }}">
                                @csrf
                                <!-- Mật khẩu -->
                                <x-input-label for="password" :value="__('Mật khẩu')" />
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" placeholder="Mời nhập mật khẩu"  name="password" required autocomplete="current-password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
                                            {{ __('Xác nhận mật khẩu') }}
                                        </x-primary-button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>

