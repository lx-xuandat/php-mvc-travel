<form action="/cart" method="post">
    <div class="form-group">
        <label for="province">Chọn tỉnh</label>
        <select class="form-control select2" id="province" name="province_id">
            <option value="">-- Chọn tỉnh --</option>
        </select>
    </div>

    <div class="form-group">
        <label for="commune">Chọn xã</label>
        <select class="form-control select2" id="commune" name="commune_id">
            <option value="">-- Chọn --</option>
        </select>
    </div>

    <button type="submit">Submit</button>
</form>
