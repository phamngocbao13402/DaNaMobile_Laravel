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
    <h1 class="text-center" style="color:black;">Thêm địa chỉ cá nhân</h1>
</div>
<form class="js-validate" novalidate="novalidate" style="box-shadow: 0 0 5px #e03102;" action="{{url('user/createaddress')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="contentform">
        <div class="leftcontact">
            
            <div class="form-group">
                <p>Tỉnh<span>*</span></p>
                <div class="input-group">
                    <span class="icon-case"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="city" aria-label="Disabled select example" id="city">
                        <option value="" selected>Chọn tỉnh thành</option>           
                    </select>
                </div>
                @error('city')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p>Quận, huyện<span>*</span></p>
                <div class="input-group">
                    <span class="icon-case"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="district" aria-label="Disabled select example" id="district" >
                        <option value="" selected>Chọn quận huyện</option>
                    </select>
                </div>
                @error('district')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p>Phường, xã<span>*</span></p>
                <div class="input-group">
                    <span class="icon-case"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="ward" aria-label="Disabled select example" id="ward">
                        <option value="" selected>Chọn phường xã</option>
                    </select>
                </div>
                @error('ward')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p>Tên đường, tòa nhà, số nhà<span>*</span></p>
                <div class="input-group">
                    <span class="icon-case"><i class="fa fa-user"></i></span>
                    <input type="text" value="" name="street" data-rule="required" />
                </div>
                @error('street')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
           
        </div>

        <div class="rightcontact">	
            <div class="form-group">
                <p>Số điện thoại<span>*</span></p>
                <div class="input-group">
                    <span class="icon-case"><i class="fa fa-user"></i></span>
                    <input type="text" value="" name="phoneNumber" data-rule="required" />
                </div>
                @error('phoneNumber')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p>Loại địa chỉ <span>*</span></p>	
                <div class="input-group">
                    <select class="form-control" name="type_address">
                        <option selected value="">Chọn địa chỉ</option>
                        <option value="0">Nhà riêng</option>
                        <option value="1">Văn Phòng</option>
                    </select>
                </div>
                @error('type_address')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>	
        </div>
        <div class="text-center">
            <button type="submit" class="button-contact btn btn-outline-primary">Thêm</button>
        </div>
    </div>
</form>	
{{-- JS Địa chỉ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
    method: "GET",
    responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
    renderCity(result.data);
    });

    function renderCity(data) {
    for (const x of data) {
        citis.options[citis.options.length] = new Option(x.Name, x.Name);
    }
    citis.onchange = function () {
        district.length = 1;
        ward.length = 1;
        if(this.value != ""){
        const result = data.filter(n => n.Name === this.value);

        for (const k of result[0].Districts) {
            district.options[district.options.length] = new Option(k.Name, k.Name);
        }
        }
    };
    district.onchange = function () {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Name === citis.value);
        if (this.value != "") {
        const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

        for (const w of dataWards) {
            wards.options[wards.options.length] = new Option(w.Name, w.Name);
        }
        }
    };
}
</script>

@endsection