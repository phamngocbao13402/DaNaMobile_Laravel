<x-guest-layout>
        
        <div class="overlay-layout">  </div>
    
        <div class="img-layout" style="background-image: url('{{asset('form/images/background.jpg')}}'); background-size: cover; background-repeat: no-repeat; background-position: center center;height:760px">
            <section class="ftco-section">
                <div class="mb-4 text-sm text-gray-600" style="text-align:center;color:#fff">
                    {{ __('Quên mật khẩu? Không vấn đề gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một liên kết đặt lại mật khẩu qua email cho phép bạn chọn một mật khẩu mới.') }}
                </div>
                <div class="container">
                    <x-slot name="logo">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        </a>
                    </x-slot>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <!-- Validation Errors -->
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section">Quên mật khẩu</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="login-wrap p-0">
                                <form class="signin-form" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <!-- Địa chỉ email -->
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Mời nhập tên email"
                                        id="email" name="email" :value="old('email')" required autofocus>
                                        @error('email')
                                            <span class="invali-feedback" role="alert" style="color: red">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="form-control btn btn-primary submit px-3">
                                            {{ __('Liên kết đặt lại mật khẩu email') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
