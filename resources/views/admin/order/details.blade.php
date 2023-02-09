@extends('admin.layouts.master')
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Đơn Hàng Chi Tiết</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{url('admin/order/details')}}">Đơn Hàng Chi Tiết</a>
                                        </li>
                                        <li class="breadcrumb-item active">Danh sách
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- list and filter start -->
                <div class="card">
                    
                    <div class="card-datatable table-responsive pt-0">
                      
                        <br><br>
                        <table class="user-list-table table dataTable no-footer dtr-column text-center" >
                            <h3>Thông tin người mua</h3>
                            <thead class="table-light ">
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Email </th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt hàng</th>                                  
                                </tr>
                            </thead>
                            <tbody>                                                                         
                            <tr data-dt-row="" data-dt-column="">
                                <td>{{$order->fullname}}</td>  
                                <td>{{$order->email}}</td> 
                                <td>{{$order->phone}}</td>                                           
                                <td>{{ $address['street'] }}, {{ $address['ward'] }}, {{ $address['district'] }}, {{ $address['city'] }}</td> 
                                <td>{{$order->created_at}}</td> 
                            </tr>                                                                                                                                                              
                            </tbody>
                        </table>

                        <br><br><br>

                        <table class="user-list-table table dataTable no-footer dtr-column text-center" >
                            <h3>Thông tin vận chuyển</h3>
                            <thead class="table-light ">
                                <tr>
                                    <th>Tên người nhận</th>
                                    <th>Địa chỉ nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Phương thức giao hàng</th>
                                    <th>Ghi chú</th>                                  
                                </tr>
                            </thead>
                            <tbody>                                              
                                <tr data-dt-row="" data-dt-column="">
                                      <td>{{$order->fullname}}</td>  
                                      <td>{{ $address['street'] }}, {{ $address['ward'] }}, {{ $address['district'] }}, {{ $address['city'] }}</td> 
                                      <td>{{$order->phone}}</td>                                           
                                      <td></td> 
                                      <td>{{$order->note}}</td> 
                                </tr>                                                                                                                    
                            </tbody>
                        </table>

                        <br><br><br>

                        <table class="user-list-table table dataTable no-footer dtr-column text-center" >
                            <h3>Chi tiết đơn hàng</h3>
                            <thead class="table-light ">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>  
                                    <th>Ảnh sp</th>
                                    <th>Số lượng </th>
                                    <th>Thành tiền</th>                                
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($detail as $item)
                                <tr data-dt-row="" data-dt-column="">
                                      <td>{{$item->id}}</td>                                             
                                      <td>{{$item->products->product_name}} - {{$item->combination_string }}</td> 
                                      <td><img src="{{asset('images/products/'.$item->combination_image)}}" alt="" width="100px"></td> 
                                      <td>{{$item->quantity}}</td> 
                                      <td>{{number_format($item->total_amount)}} đ</td>
                                </tr>
                            @endforeach                                       
                            </tbody>
                        </table>

                        
                        <div class="d-flex justify-content-between mx-2 row mb-1">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Hiển thị 0 đến 0 của 0 mục</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                            <a href=""></a>
                                        </li>
                                        <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
                                            <a href=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new user starts-->
                    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                        <div class="modal-dialog">
                            <form class="add-new-user modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm mới</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" name="user-fullname" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-uname">Username</label>
                                        <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" placeholder="Web Developer" name="user-name" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" name="user-email" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-contact">Contact</label>
                                        <input type="text" id="basic-icon-default-contact" class="form-control dt-contact" placeholder="+1 (609) 933-44-22" name="user-contact" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-company">Company</label>
                                        <input type="text" id="basic-icon-default-company" class="form-control dt-contact" placeholder="PIXINVENT" name="user-company" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="country">Country</label>
                                        <select id="country" class="select2 form-select">
                                            <option value="Australia">USA</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="user-role">User Role</label>
                                        <select id="user-role" class="select2 form-select">
                                            <option value="subscriber">Subscriber</option>
                                            <option value="editor">Editor</option>
                                            <option value="maintainer">Maintainer</option>
                                            <option value="author">Author</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="user-plan">Select Plan</label>
                                        <select id="user-plan" class="select2 form-select">
                                            <option value="basic">Basic</option>
                                            <option value="enterprise">Enterprise</option>
                                            <option value="company">Company</option>
                                            <option value="team">Team</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal to add new user Ends-->
                </div>
                <!-- list and filter end -->
            </section>
            <!-- users list ends -->

        </div>
    </div>
</div>
@endsection