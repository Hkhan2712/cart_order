<div class="card mb-4">
    <div class="card-body">
        <div class="checkout-item">
            <div class="avatar checkout-icon p-1">
                <div class="avatar-title rounded-circle bg-primary">
                    <i class="bx bxs-receipt text-white font-size-20"></i>
                </div>
            </div>
            <h5 class="font-size-16 mb-1">Billing Info</h5>
            <form>
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="billing_name" required>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="billing_email" required>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="billing_phone" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" name="billing_address" rows="2" required></textarea>
                </div>

                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">Country</label>
                        <select class="form-control" name="billing_country">
                            <option value="">Select</option>
                            <option value="VN">Vietnam</option>
                            <option value="US">USA</option>
                            {{-- ... --}}
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="billing_city">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">Zip</label>
                        <input type="text" class="form-control" name="billing_zip">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>