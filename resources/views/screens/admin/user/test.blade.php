<div class="">
    <div class="form-group">
        <label>Mã giao dịch:</label>
        <input class="form-control form-control-lg" value="${data.invoice_no}">
    </div>
    <div class="form-group">
        <label>Tên khách hàng:</label>
        <input class="form-control form-control-lg" value="${name}">
    </div>
    <div class="form-group">
        <span>Số điện thoại:</span>
        <input class="form-control form-control-lg" value="${phone_number}">
    </div>
    <div class="form-group">
        <label>Mã số thuế:</label>
        <input class="form-control form-control-lg" value="${tax_code}">
    </div>
    <div class="form-group">
        <label>Loại thẻ:</label>
        <input class="form-control form-control-lg" value="${data.card_brand}">
    </div>
    <div class="form-group">
        <label>Loại tiền tệ:</label>
        <input class="form-control form-control-lg" value="${data.currency}">
    </div>
    <div class="form-group">
        <label>Nội dung:</label>
        <input class="form-control form-control-lg" value="${data.description}">
    </div>
    <div class="form-group">
        <label>Phương thức thanh toán:</label>
        <input class="form-control form-control-lg" value="${data.method}">
    </div>
    <div class="form-group">
        <label>Trạng thái thanh toán:</label>
        <input class="form-control form-control-lg"
               value="${present_status == 3 && payment_status == 1 ? 'Thành công' : 'Thất bại'}">
    </div>
    <div class="form-group">
        <label>Trạng thái thanh toán thực tế (9PAY):</label>
        <input class="form-group form-control-lg" value="${status}">
    </div>
    <div class="form-group">
        <label>Thời gian giao dịch:</label>
        <input
            class="form-group form-control-lg">
    </div>
    <div class="form-group">
        ${
        data.status == 5 && !(payment_status == 1 && present_status == 3) ? `` : ''
        }
    </div>
</div>
