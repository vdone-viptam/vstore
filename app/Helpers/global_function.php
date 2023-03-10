<?php
function status9Pay($status)
{
    switch ($status) {
        case 2: {
            return [
                'message' => 'Giao dịch đang xử lý'
            ];
        }
        case 3: {
            return [
                'message' => 'Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)'
            ];
        }
        case 5: {
            return [
                'message' => 'Giao dịch thành công'
            ];
        }
        case 6: {
            return [
                'message' => 'Giao dịch thất bại'
            ];
        }
        case 8: {
            return [
                'message' => 'Giao dịch bị hủy'
            ];
        }
        case 9: {
            return [
                'message' => 'Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)'
            ];
        }
        case 16: {
            return [
                'message' => 'Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toán Chuyển khoản ngân hàng)'
            ];
        }
        default: {
            return [
                'message' => 'Giao dịch đang xử lý'
            ];
        }

    }
}

//2 - Giao dịch đang xử lý
//3 - Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)
//5 - Giao dịch thành công
//6 - Giao dịch thất bại
//8 - Giao dịch bị hủy
//9 - Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)
//16 - Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toán Chuyển khoản ngân hàng)
