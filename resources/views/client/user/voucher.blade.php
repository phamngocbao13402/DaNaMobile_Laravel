@extends('client.layouts.master')
@section('main')
<style>
    .cl-black{
        color: black !important;
    }
	.event-schedule-area .section-title .title-text {
    margin-bottom: 50px;
	}

	.event-schedule-area .tab-area .nav-tabs {
		border-bottom: inherit;
	}

	.event-schedule-area .tab-area .nav {
		border-bottom: inherit;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		margin-top: 80px;
	}

	.event-schedule-area .tab-area .nav-item {
		margin-bottom: 75px;
	}
	.event-schedule-area .tab-area .nav-item .nav-link {
		text-align: center;
		font-size: 22px;
		color: #333;
		font-weight: 600;
		border-radius: inherit;
		border: inherit;
		padding: 0px;
		text-transform: capitalize !important;
	}
	.event-schedule-area .tab-area .nav-item .nav-link.active {
		color: #4125dd;
		background-color: transparent;
	}

	.event-schedule-area .tab-area .tab-content .table {
		margin-bottom: 0;
		width: 80%;
	}
	.event-schedule-area .tab-area .tab-content .table thead td,
	.event-schedule-area .tab-area .tab-content .table thead th {
		border-bottom-width: 1px;
		font-size: 20px;
		font-weight: 600;
		color: #252525;
	}
	.event-schedule-area .tab-area .tab-content .table td,
	.event-schedule-area .tab-area .tab-content .table th {
		border: 1px solid #b7b7b7;
		padding-left: 30px;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th .heading,
	.event-schedule-area .tab-area .tab-content .table tbody td .heading {
		font-size: 16px;
		text-transform: capitalize;
		margin-bottom: 16px;
		font-weight: 500;
		color: #252525;
		margin-bottom: 6px;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th span,
	.event-schedule-area .tab-area .tab-content .table tbody td span {
		color: #4125dd;
		font-size: 18px;
		text-transform: uppercase;
		margin-bottom: 6px;
		display: block;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th span.date,
	.event-schedule-area .tab-area .tab-content .table tbody td span.date {
		color: #656565;
		font-size: 14px;
		font-weight: 500;
		margin-top: 15px;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th p {
		font-size: 14px;
		margin: 0;
		font-weight: normal;
	}

 .section-title .title-text h2 {
		margin: 0px 0 15px;
	}

 ul.custom-tab {
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		border-bottom: 1px solid #dee2e6;
		margin-bottom: 30px;
	}
 ul.custom-tab li {
		margin-right: 70px;
		position: relative;
	}
 ul.custom-tab li a {
		color: #252525;
		font-size: 25px;
		line-height: 25px;
		font-weight: 600;
		text-transform: capitalize;
		padding: 35px 0;
		position: relative;
	}
 ul.custom-tab li a:hover:before {
		width: 100%;
	}
 ul.custom-tab li a:before {
		position: absolute;
		left: 0;
		bottom: 0;
		content: "";
		background: #4125dd;
		width: 0;
		height: 2px;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 ul.custom-tab li a.active {
		color: #4125dd;
	}

 .primary-btn {
		margin-top: 40px;
	}

 .tab-content .table {
		-webkit-box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
		box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
		margin-bottom: 0;
	}
 .tab-content .table thead {
		background-color: #007bff;
		color: #fff;
		font-size: 20px;
	}
 .tab-content .table thead tr th {
		padding: 20px;
		border: 0;
	}
 .tab-content .table tbody {
		background: #fff;
	}
 .tab-content .table tbody tr.inner-box {
		border-bottom: 1px solid #dee2e6;
	}
 .tab-content .table tbody tr th {
		border: 0;
		padding: 30px 20px;
		vertical-align: middle;
	}
 .tab-content .table tbody tr th .event-date {
		color: #252525;
		text-align: center;
	}
 .tab-content .table tbody tr th .event-date span {
		font-size: 50px;
		line-height: 50px;
		font-weight: normal;
	}
 .tab-content .table tbody tr td {
		padding: 30px 20px;
		vertical-align: middle;
	}
 .tab-content .table tbody tr td .r-no span {
		color: #252525;
	}
 .tab-content .table tbody tr td .event-wrap h3 a {
		font-size: 20px;
		line-height: 20px;
		color: #cf057c;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 .tab-content .table tbody tr td .event-wrap h3 a:hover {
		color: #4125dd;
	}
 .tab-content .table tbody tr td .event-wrap .categories {
		display: -webkit-inline-box;
		display: -ms-inline-flexbox;
		display: inline-flex;
		margin: 10px 0;
	}
 .tab-content .table tbody tr td .event-wrap .categories a {
		color: #252525;
		font-size: 16px;
		margin-left: 10px;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 .tab-content .table tbody tr td .event-wrap .categories a:before {
		content: "\f07b";
		font-family: fontawesome;
		padding-right: 5px;
	}
 .tab-content .table tbody tr td .event-wrap .time span {
		color: #252525;
	}
 .tab-content .table tbody tr td .event-wrap .organizers {
		display: -webkit-inline-box;
		display: -ms-inline-flexbox;
		display: inline-flex;
		margin: 10px 0;
	}
 .tab-content .table tbody tr td .event-wrap .organizers a {
		color: #4125dd;
		font-size: 16px;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 .tab-content .table tbody tr td .event-wrap .organizers a:hover {
		color: #4125dd;
	}
 .tab-content .table tbody tr td .event-wrap .organizers a:before {
		content: "\f007";
		font-family: fontawesome;
		padding-right: 5px;
	}
 .tab-content .table tbody tr td .primary-btn {
		margin-top: 0;
		text-align: center;
	}
 .tab-content .table tbody tr td .event-img img {
		width: 150px;
		border-radius: 8px;
	}
</style>
<main id="content" role="main" class="checkout-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{url('/')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Voucher</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center" style="color: red">Kho Voucher</h1>
        </div>
        <div class="row mb-5">
            <div class="col-lg-12">
             
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">                            
                                <tbody>
									<?php $i=0 ?>
									@foreach($list_vu as $vu)
                                    <tr class="inner-box">
                                        <th scope="row">
                                            <div class="">
                                                <span><?php  $i++; echo $i ?></span>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="event-img">
												@if($vu->vu_voucher->type == "Giảm theo tiền")
                                                <img src="{{asset('images/logo/price.jpg')}}" alt="" width="150px"/>
												@else
                                                <img src="{{asset('images/logo/per.jpg')}}" alt="" width="150px"/>
												@endif	
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a href="#">{{$vu->vu_voucher->code}}</a></h3>
                                                <div class="meta">
                                                    <div class="">
                                                        <a href="#">{{$vu->vu_voucher->type}}</a>
                                                    </div>
                                                    {{-- <div class="categories">
                                                        <a href="#">Inspire</a>
                                                    </div> --}}
                                                    <div class="time">
                                                        <span>Hạn sử dụng: {{$vu->vu_voucher->time}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="r-no">
												@if($vu->vu_voucher->type == "Giảm theo tiền")
                                                <span>{{$vu->vu_voucher->value}} đ</span>
												@else
                                                <span>{{$vu->vu_voucher->value}} %</span>
												@endif												
                                            </div>
                                        </td>
                                        <td>
                                            <div class="primary-btn">
                                                <a class="btn btn-primary" href="{{url('product/detail',[$vu->vu_voucher->product_id])}}">Dùng ngay</a>
                                            </div>
                                        </td>
                                    </tr>
									@endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /col end-->
        </div>
    </div>
</main>
@endsection