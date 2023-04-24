<script src="{{asset('asset/assets/vendor/charts/chart/chart.js')}}"></script>

<script>
    $(document).ready(function () {
        let dataRevenueChartMonth = @json($dataRevenueChartMonth) ;
        let dataRevenueChartYear = @json($dataRevenueChartYear) ;
        let dataOrderChartMonth = @json($dataOrderChartMonth) ;
        let dataOrderRangeTimeYear = @json($dataOrderRangeTimeYear) ;

        // lấy data từ dữ liệu bên BE
        let data_chart_week = pushValueChart(dataRevenueChartMonth,"week");
        let data_chart_month = pushValueChart(dataRevenueChartMonth,"month");
        let data_chart_one_year = pushValueChart(dataRevenueChartYear,"one_year");
        let data_chart_three_year = pushValueChart(dataRevenueChartYear,"three_year");

        let data_order_chart_week = pushValueChart(dataOrderChartMonth,"week");
        let data_order_chart_month = pushValueChart(dataOrderChartMonth,"month");
        let data_order_chart_one_year = pushValueChart(dataOrderRangeTimeYear,"one_year");
        let data_order_chart_three_year = pushValueChart(dataOrderRangeTimeYear,"three_year");


        // doanh thu trong 1 tuần, 1 tháng, 1 năm, 3 năm
        let revenue_week = dataRevenueChartMonth['moneyTotal7Days'];
        let revenue_month = dataRevenueChartMonth['moneyTotal30Days'];
        let revenue_year = dataRevenueChartYear['moneyTotalOneYear'];
        let revenue_three_year = dataRevenueChartYear['moneyTotalThreeYear'];

        // order trong 1 tuần, 1 tháng, 1 năm, 3 năm
        let order_week = dataOrderChartMonth['orderTotal7Days'];
        let order_month = dataOrderChartMonth['orderTotal30Days'];
        let order_year = dataOrderRangeTimeYear['orderTotalOneYear'];
        let order_three_year = dataOrderRangeTimeYear['orderTotalThreeYear'];

        $('.money-revenue').html(convertVND(revenue_week));
        $('.count-order').html(order_week);
        // push data và 1 mảng chứa time và money
        function pushValueChart(dataChartFromBE,param) {
            if(dataChartFromBE){
                let dataSub = [];
                let labels = [];
                let money = [];
                let dataChart = dataChartFromBE[param];
                dataChart.forEach(element => {
                    labels.push(element.time)
                    money.push(element.money)
                });
                dataSub.push( labels, money);
                return dataSub;
            }
            return [];
        }

        // từ 1 mảng chứa time và money => gán nó vào data để chart có thể sử dụng
        function pushValueLabelData(data_chart,label) {
            let data_chart_sub =
            {
                labels: data_chart[0],
                datasets: [
                    {
                        label: label,
                        backgroundColor:"#3e95cd",
                        data: data_chart[1]
                    }
                ]
            };
            return data_chart_sub;
        }

        data_chart_week = pushValueLabelData(data_chart_week,'VNĐ');
        data_chart_month = pushValueLabelData(data_chart_month,'VNĐ');
        data_chart_one_year = pushValueLabelData(data_chart_one_year,'VNĐ');
        data_chart_three_year = pushValueLabelData(data_chart_three_year,'VNĐ');

        data_order_chart_week = pushValueLabelData(data_order_chart_week,'Số lượng');
        data_order_chart_month = pushValueLabelData(data_order_chart_month,'Số lượng');
        data_order_chart_one_year = pushValueLabelData(data_order_chart_one_year,'Số lượng');
        data_order_chart_three_year = pushValueLabelData(data_order_chart_three_year,'Số lượng');


        var chartObject = new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: data_chart_week,
            options: {
                title: {
                    display: true,
                    text: '-'
                }, legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            console.log(tooltipItem)
                            return tooltipItem.yLabel;
                        }
                    }
                },
            }
        });

        var chartOrderObject = new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: data_order_chart_week,
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: '-'
                }
            }
        });
        $('.select-revenue').change(function () {
            $value = $('.select-revenue option:selected').text();
            $('.date-revenue').html($value);
            let value_check = $(this).find(":selected").val();
            switch (value_check) {
                case "0":
                    changeDataChart(chartObject, data_chart_week);
                    $('.money-revenue').html(convertVND(revenue_week));
                    break;
                case "1":
                    changeDataChart(chartObject,data_chart_month);
                    $('.money-revenue').html(convertVND(revenue_month));
                    break;
                case "2":
                    changeDataChart(chartObject,data_chart_one_year);

                    $('.money-revenue').html(convertVND(revenue_year));

                    break;
                case "3":
                    changeDataChart(chartObject,data_chart_three_year);

                    $('.money-revenue').html(convertVND(revenue_three_year));

                    break;
                default:
                    break;
            }
        });
        $('.select-order').change(function () {
            $value = $('.select-order option:selected').text();
            $('.date-order').html($value);
            let value_check = $(this).find(":selected").val();
            switch (value_check) {
                case "0":
                    changeDataChart(chartOrderObject, data_order_chart_week);
                    $('.count-order').html(order_week);
                    break;
                case "1":
                    changeDataChart(chartOrderObject, data_order_chart_month);
                    $('.count-order').html(order_month);
                    break;
                case "2":
                    changeDataChart(chartOrderObject, data_order_chart_one_year);
                    $('.count-order').html(order_year);
                    break;
                case "3":
                    changeDataChart(chartOrderObject, data_order_chart_three_year);
                    $('.count-order').html(order_three_year);
                    break;
                default:
                    break;
            }
        });
        $('.select-date').change(function () {
            $value = $('.select-date option:selected').text();
            $('.date').html($value);
            let value_check = $(this).find(":selected").val();
            switch (value_check) {
                case "0":
                    changeDataChart(chartObject, data_chart_week);
                    changeDataChart(chartOrderObject, data_order_chart_week);
                    $('.money-revenue').html(convertVND(revenue_week));
                    $('.count-order').html(order_week);
                    break;
                case "1":
                    changeDataChart(chartObject,data_chart_month);
                    changeDataChart(chartOrderObject, data_order_chart_month);
                    $('.money-revenue').html(convertVND(revenue_month));
                    $('.count-order').html(order_month);
                    break;
                case "2":
                    changeDataChart(chartObject,data_chart_one_year);
                    changeDataChart(chartOrderObject, data_order_chart_one_year);
                    $('.money-revenue').html(convertVND(revenue_year));
                    $('.count-order').html(order_year);
                    break;
                case "3":
                    changeDataChart(chartObject,data_chart_three_year);
                    changeDataChart(chartOrderObject, data_order_chart_three_year);
                    $('.money-revenue').html(convertVND(revenue_three_year));
                    $('.count-order').html(order_three_year);
                    break;
                default:
                    break;
            }
        });
        function changeDataChart(chart,data) {
            if(data){
                chart.data = data;
                chart.update();
            }
        }

    })

</script>
