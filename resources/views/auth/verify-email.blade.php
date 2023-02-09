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
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết mà chúng tôi vừa gửi qua email cho bạn không? Nếu bạn không nhận được email, chúng tôi sẽ sẵn lòng gửi cho bạn một email khác.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp trong quá trình đăng ký.') }}
                    </div>
                @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="form-control btn btn-primary submit px-3">
                        {{ __('Gửi lại email xác nhận') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="form-control btn btn-primary submit px-3">
                    {{ __('Đăng xuất') }}
                    </x-primary-button>
            </form>
        </div>
</x-guest-layout>
