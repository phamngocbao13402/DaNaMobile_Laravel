$(document).ready(function () {
    $(document).on("change", ".select-statistical-js", function (e) {
        let optionStat = $('#choise_option_statistical').val();
        let orderStat = $('#choise_order_statistical').val();
        let amountStat = $('#choise_amount_statistical').val();
        let startDay = $('#start-day').val();
        let endDay = $('#end-day').val();

        data = {startDay, endDay, optionStat, orderStat, amountStat};
        if (optionStat == 1) {
            fetchSellingStatistical(data);
        } else if (optionStat == 2) {
            fetchRevenueStatistical(data);
        } else {
            fetchUnSoldProduts(data);
        }
    });

    function fetchSellingStatistical(data) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "GET",
            url: "/admin/statistical/list",
            data: data,
            dataType: "json",
            success: function (response) {
                loadChart(response.productStatistical);
                $("table").empty();
                $("table").append(
                    `
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ngày bán</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Ảnh</th>
                            <th>Đơn giá</th>
                            <th>Tổng bán được</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    `
                )
                $.each(response.productStatistical, function (index, product) { 
                    let date = moment(product.created_at, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
                    $("tbody").append(
                        `
                        <tr data-dt-row="" data-dt-column="">
                            <td></td>
                            <td>${date}</td>
                            <td>${product.product_name} ${product.combination_string}</td>
                            <td>${product.category_name}</td>
                            <td><img class="rounded" src="../../images/products/${product.combination_image}"
                                    width="150px" height="100px" style="display:block; margin: 0 auto;"></td>
                            <td>${Intl.NumberFormat('en-US').format(product.price)} đ</td>
                            <td>${product.totalSold}</td>
                            <td>${product.avilableStock}</td>
                    
                        </tr>
                        
                        `
                    )
                });
                paginationStat('tbody tr');



            }, error: function (response) {
                console.log(response);
            }
        });
    }

    function fetchRevenueStatistical(data) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "GET",
            url: "/admin/statistical/list",
            data: data,
            dataType: "json",
            success: function (response) {
                $("table").empty();
                $("table").append(
                    `
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ngày bán</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Ảnh</th>
                            <th>Đơn giá</th>
                            <th>Số lượng bán được</th>
                            <th>Tổng doanh thu</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    `
                )
                $.each(response.productStatistical, function (index, product) { 
                    let date = moment(product.created_at, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
                    $("tbody").append(
                        `
                        <tr data-dt-row="" data-dt-column="">
                            <td></td>
                            <td>${date}</td>
                            <td>${product.product_name} ${product.combination_string}</td>
                            <td>${product.category_name}</td>
                            <td><img class="rounded" src="../../images/products/${product.combination_image}"
                                    width="150px" height="100px" style="display:block; margin: 0 auto;"></td>
                            <td>${Intl.NumberFormat('en-US').format(product.price)} đ</td>
                            <td>${product.totalSold}</td>
                            <td>${Intl.NumberFormat('en-US').format(product.totalRevenue)} đ</td>
                            <td>${product.avilableStock}</td>
                        </tr>
                        `
                    )
                });
                paginationStat('tbody tr');

            }, error: function (response) {
                console.log(response);
            }
        });
    }

    function fetchUnSoldProduts(data) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "GET",
            url: "/admin/statistical/list",
            data: data,
            dataType: "json",
            success: function (response) {
                $("table").empty();
                $("table").append(
                    `
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ngày nhập hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Ảnh</th>
                            <th>Đơn giá</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    `
                )
                $.each(response.productStatistical, function (index, product) { 
                    let date = moment(product.created_at, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
                    $("tbody").append(
                        `
                        <tr data-dt-row="" data-dt-column="">
                            <td></td>
                            <td>${date}</td>
                            <td>${product.product_name} ${product.combination_string}</td>
                            <td>${product.category_name}</td>
                            <td><img class="rounded" src="../../images/products/${product.combination_image}"
                                    width="150px" height="100px" style="display:block; margin: 0 auto;"></td>
                            <td>${Intl.NumberFormat('en-US').format(product.price)} đ</td>
                            <td>${product.avilableStock}</td>
                        </tr>
                        `
                    )
                });
                paginationStat('tbody tr');

            }, error: function (response) {
                console.log(response);
            }
        });
    }
    
    function paginationStat(element) {
    
        let items = $(element);
        let numItems = items.length;
        let perPage = 5;

        items.slice(perPage).hide();

        $('#pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function (pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });
    }

    $(document).on("click", "#show-chart-stat", function (e) {
        e.preventDefault();
        $("#chart-statistical").modal("show");
    });

    function loadChart(dataChart) {
        let dataT = "['Sản phẩm', 'Số lượng bán được']";
        dataChart.forEach(item => {
            dataT += `['${item.product_name}',${item.totalSold}], `
        });
        console.log(dataT);
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
           ,
            dataT
        ]);

        var options = {
        title:'World Wide Wine Production',
        is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
        }
    }

});

