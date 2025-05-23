<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="code" label="Enter Name Coupon" hint="Enter Name Coupon..."
            oldVal="{{ @$coupon->code }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <div><label for="discount_type">Select Type Discount Coupon</label></div>
            <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                <option value="">Select Type Discount Coupon</option>
                <option value="fixed" @selected(@$coupon->discount_type == 'fixed')>fixed</option>
                <option value="percentage" @selected(@$coupon->discount_type == 'percentage')>percentage</option>

            </select>

            @error('discount_type')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="number" name="discount_value" label="Enter Discount Value Coupon"
            hint="Enter Discount Value Coupon..." oldVal="{{ @$coupon->discount_value }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="number" name="min_order_amount" label="Enter Min Order Amount Coupon"
            hint="Enter Min Order Amount Coupon..." oldVal="{{ @$coupon->min_order_amount }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="number" name="usage_limit" label="Enter Usage Limit Coupon"
            hint="Enter Usage Limit Coupon..." oldVal="{{ @$coupon->usage_limit }}"></x-form.input>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <x-form.input type="date" min="{{ now()->format('Y-m-d') }}" name="start_date"
            label="Enter Start Date Coupon" hint="Enter Start Date Coupon..." :oldVal="\Carbon\Carbon::parse(@$coupon->end_date)->format('Y-m-d') ?? now()->format('Y-m-d')"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="date" min="{{ now()->format('Y-m-d') }}" name="end_date" label="Enter End Date Coupon"
            hint="Enter End Date Coupon..." :oldVal="\Carbon\Carbon::parse(@$coupon->end_date)->format('Y-m-d') ?? now()->format('Y-m-d')"></x-form.input>
    </div>
</div>
