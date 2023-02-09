@extends('client.layouts.master')
@section('main')
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{url('/')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Liên hệ</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->


    <div class="container" style="color: black">
        <div class="mb-5">
            <h1 class="text-center">Liên hệ</h1>
        </div>
        @if (Session::has('success'))
            <h1 style="margin-left: 20px;color: red">{{Session::get('success')}}</h1>
        @endif
        <div class="row mb-10">
            <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                <div class="mr-xl-6">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Bạn có thắc mắc gì ? Hãy liên hệ với chúng tôi</h3>
                    </div>
                    
                    <form class="js-validate" novalidate="novalidate" action="{{url('contact')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Họ và tên
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name" placeholder="" aria-label="" required="" data-msg="Please enter your frist name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Địa chỉ email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" name="email" placeholder="" value=""  data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Tiêu đề
                                    </label>
                                    <input type="text" class="form-control" name="subject" placeholder="" aria-label="" data-msg="Please enter subject." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-12">
                                <div class="js-form-message mb-4">
                                    <label class="form-label">
                                        Nội dung
                                    </label>
                                    <div class="input-group">
                                        <textarea class="form-control p-5" rows="4" name="message" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary-dark-w px-5">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-xl-6">
                <div class="mb-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31098.323046338846!2d108.22662651928634!3d16.05212088979534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142197d122a3a2f%3A0x40fd7aefb9e41361!2sKokoro%20Cafe!5e1!3m2!1svi!2s!4v1670487378298!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Địa chỉ của chúng tôi</h3>
                </div>
                <address class="mb-6 text-lh-23">
                    55/7 Kiệt 55 Ngũ Hành Sơn,
                    Bắc Mỹ Phú,
                    Ngũ Hành Sơn,
                    Đà Nẵng 550000,
                    Việt Nam
                    <div class="">Hỗ trợ: (84) 0917 608 264, (84) 874 548</div>
                    <div class="">Email: <a class="text-blue text-decoration-on" href="mailto:contact@yourstore.com">danamobie@gmail.com</a></div>
                </address>
                <h5 class="font-size-14 font-weight-bold mb-3">Thời gian mở cửa</h5>
                <div class="">Từ thứ 2 đến thứ 6: 9h-21h</div>
                <div class="mb-6">Từ thứ 7 đến chủ nhật: 9h-20h</div>
            </div>
        </div>
        <!-- Brand Carousel -->
        <div class="mb-8">
            <div class="py-2 border-top border-bottom">
                <div class="js-slick-carousel u-slick my-1" data-slides-show="5" data-slides-scroll="1"
                    data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                    data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                    data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right" data-responsive='[{
                        "breakpoint": 992,
                        "settings": {
                            "slidesToShow": 2
                        }
                    }, {
                        "breakpoint": 768,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }, {
                        "breakpoint": 554,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }]'>
                    @foreach ($bannerlist as $list)
                        
                    <div class="js-slide">
                        <a href="{{$list->location}}" class="link-hover__brand">
                            <img class="img-fluid m-auto"
                                src="{{asset('images/banner/'.$list->banner_img)}}" alt="Image Description" style="width: 80%; max-height:7rem;">
                        </a>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
        <!-- End Brand Carousel -->
    </div>
</main>

@endsection