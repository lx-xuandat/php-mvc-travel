$(function () {
    $('#province').select2({ placeholder: "Chọn tỉnh...", allowClear: true });
    $('#commune').select2({ placeholder: "Chọn xã...", allowClear: true });

    // Load provinces.json
    $.getJSON('/json/provinces.json', function (provinces) {
        provinces.forEach(function (p) {
            $('#province').append(new Option(p.ten, p.ma));
        });

        // Lưu map mã -> tên
        window.provinceMap = {};
        provinces.forEach(function (p) {
            window.provinceMap[p.ma] = p.ten;
        });
    });

    $('#province').on('change', function () {
        var provinceId = $(this).val();
        $('#commune').empty().append(new Option('-- Chọn --', '')).trigger('change');

        if (!provinceId) return;

        var file = '/json/province_' + provinceId + '.json';

        $.getJSON(file, function (communes) {
            communes.forEach(function (c) {
                $('#commune').append(new Option(c.ten, c.ma));
            });
            $('#commune').trigger('change');
        }).fail(function () {
            alert("Không tìm thấy file dữ liệu cho " + provinceId);
        });
    });
});