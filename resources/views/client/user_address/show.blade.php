@extends('client.layouts.master')
@section('main')
<style>
    /* thông tin tài khoản */
    .info p {
    text-align:center;
    color: #999;
    text-transform:none;
    font-weight:600;
    font-size:15px;
    margin-top:2px
    }

    .info i {
    color:#F6AA93;
    }
    form h1 {
    font-size: 18px;
    background: #F6AA93 none repeat scroll 0% 0%;
    color: rgb(255, 255, 255);
    padding: 22px 25px;
    border-radius: 5px 5px 0px 0px;
    margin: auto;
    text-shadow: none; 
    text-align:left
    }

    form {
    border-radius: 5px;
    max-width:900px;
    width:100%;
    margin: 5% auto;
    background-color: #FFFFFF;
    overflow: hidden;
    }

    p span {
    color: #F00;
    }

    p {
    margin: 0px;
    font-weight: 500;
    line-height: 2;
    color:#333;
    }

    h1 {
    text-align:center; 
    color: #666;
    text-shadow: 1px 1px 0px #FFF;
    margin:50px 0px 0px 0px
    }

    input {
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #eee;
    margin-bottom: 15px;
    width: 75%;
    height: 40px;
    float: left;
    padding: 0px 15px;
    }

    a {
    text-decoration:inherit
    }

    textarea {
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #EEE;
    margin: 0;
    width: 75%;
    height: 130px; 
    float: left;
    padding: 0px 15px;
    }

    .form-group {
    overflow: hidden;
    clear: both;
    }

    .icon-case {
    width: 35px;
    float: left;
    border-radius: 5px 0px 0px 5px;
    background:#eeeeee;
    height:42px;
    position: relative;
    text-align: center;
    line-height:40px;
    }

    i {
    color:#555;
    }

    .contentform {
    padding: 40px 30px;
    }

    .button-contact{
    font-size: 12px;
    background-color: #e03102;
    color: #FFF;
    width: 25%;
    border:0;
    padding: 17px 25px;
    border-radius: 5px 5px 5px 5px;
    cursor: pointer;
    margin-top: 40px;
    font-size: 12px;
    }

    .leftcontact {
    width:49.5%; 
    float:left;
    border-right: 1px dotted #CCC;
    box-sizing: border-box;
    padding: 0px 15px 0px 0px;
    }

    .rightcontact {
    width:49.5%;
    float:right;
    box-sizing: border-box;
    padding: 0px 0px 0px 15px;
    }

    .validation {
    display:none;
    margin: 0 0 10px;
    font-weight:400;
    font-size:13px;
    color: #DE5959;
    }

    #sendmessage {
    border:1px solid #fff;
    display:none;
    text-align:center;
    margin:10px 0;
    font-weight:600;
    margin-bottom:30px;
    background-color: #EBF6E0;
    color: #5F9025;
    border: 1px solid #B3DC82;
    padding: 13px 40px 13px 18px;
    border-radius: 3px;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.03);
    }

    #sendmessage.show,.show  {
    display:block;
    }
  /* end thông tin tài khoản */
</style>
<div class="mb-5">
    <h1 class="text-center" style="color:black;">Địa chỉ thông tin cá nhân</h1>
</div>
<form class="js-validate" novalidate="novalidate" style="box-shadow: 0 0 5px #e03102;">
    <div class="contentform">
        <div class="row">
            @foreach ($users as $user)
                <div class="form-group col-md-10">
                    <p>Địa chỉ: 
                        (
                            <?php
                                if($user["type_address"]==1){
                                    echo "Văn phòng";
                                }else {
                                    echo "Nhà riêng";
                                }
                            ?>
                        )
                        <span class="text-danger">*</span>
                    </p>
                    <input type="text" name="" id="" data-rule="" value="{{ $user -> city }} - {{ $user -> district }} - {{ $user -> ward }} - {{ $user -> street }}" disabled/>
                </div>
                {{-- <div class="col-md-2">
                    <a href="{{url('/user/updateaddress',[$user->user_id])}}"><button type="button" class="btn btn-outline-primary">Chỉnh sửa</button></a>
                </div> --}}

                <div class="col-md-1">
                    <a href="{{url('/user/delete',[$user->id])}}"><button type="button" class="btn btn-outline-primary">Xóa</button></a>
                </div>

                <div class="form-group col-md-10">
                    <!-- Input -->
                    <p>Số điện thoại
                        <span class="text-danger">*</span>
                    </p>
                    <input type="email" name="" placeholder="" value="{{ $user->phoneNumber }}"  data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" disabled>
                    <!-- End Input -->
                </div>
            @endforeach
        </div>
        <a href="{{url('/user/createaddress',[Auth::id()])}}"><button type="button" class="button-contact btn btn-outline-primary">Thêm địa chỉ</button></a>
        <a href="{{url('/user',[Auth::id()])}}"><button type="button" class="button-contact btn btn-outline-primary">Quay lại thông tin cá nhân</button></a>
    </div>
  
</form>	
@endsection