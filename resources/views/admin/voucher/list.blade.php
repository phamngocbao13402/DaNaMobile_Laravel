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
                                <h2 class="content-header-title float-start mb-0">Phiếu giảm giá</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{url('admin/voucher/list')}}">Phiếu giảm giá</a>
                                        </li>
                                        <li class="breadcrumb-item active">Danh sách
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                                    <form action="" method="get">
                                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                            <label>
                                                Tìm kiếm:
                                                <input type="text" class="form-control" placeholder aria-controls="DataTables_Table_0" name="key_search">
                                            </label>
                                            <div class="dt-buttons d-inline-flex mt-50">
                                                <button class="dt-button buttons-collection btn btn-outline-secondary me-2"
                                                tabindex="0" aria-controls="DataTables_Table_0" type="submit" aria-haspopup="true">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-lg-6 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <a href="{{route('voucher.create')}}"><button type="button" class="dt-button add-new btn btn-primary"
                                            tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">Thêm Voucher mới</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card-datatable table-responsive pt-0">
                        <table class="user-list-table table">
                            <thead class="table-light">
                                <tr>

                                    <th>ID</th>
                                    <th>Mã</th>
                                    <th>Loại hình</th>
                                    <th>Giá trị</th>
                                    <th>Số lượng</th>
                                    <th>Thời gian còn lại</th>
                                    <th>Trạng thái</th>
                                    <th>Tên sản phẩm</th>
                                    <th colspan="2" style="text-align: center">Thao tác</th>
                                </tr>
                            </thead>
                           <tbody>

                            @foreach ($result as $voucher)

                            <tr data-dt-row="" data-dt-colum="">
                                <td>{{$voucher->id}}</td>
                                <td>{{$voucher->code}}</td>
                                <td>{{$voucher->type}}</td>
                                <td>{{number_format($voucher->value)}}</td>
                                <td>{{$voucher->numberof}}</td>
                                <td>{{$voucher->time}}</td>
                                <td>
                                    @if($voucher->status == 1)
                                       <span class="alert-success">Đang áp dụng</span>
                                    @elseif($voucher->status == 2)
                                        <span class="alert-danger">Vô hiệu hoá</span>
                                    @endif
                                </td>
                                <td>{{$voucher->voucher_product->product_name}}</td>
                                <td><a href="{{url('admin/voucher/edit',[$voucher->id])}}"><button type="button" class="btn btn-gradient-success"><i data-feather='edit'></i></button></a></td>
                                <td><a href="{{url('admin/voucher/delete',[$voucher->id])}}"><button type="button" class="btn btn-gradient-danger"><i data-feather='trash-2'></i></button></a></td>
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                        <div id="pagination-container"></div>
                        <div>

                        </div>
                    </div>
                    <!-- Modal to add new user starts-->
                    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                        <div class="modal-dialog">
                            <form class="add-new-user modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="{{asset('admin_js/pagination_js.js')}}"></script>
