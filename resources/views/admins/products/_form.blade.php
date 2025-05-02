<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="name" label="Enter Name Product" hint="Enter Name Product..."
            oldVal="{{ @$product->name }}"></x-form.input>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <x-form.input type="number" name="price" label="Enter Price Product" hint="Enter Price Product..."
            oldVal="{{ @$product->price }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="number" name="quantity" label="Enter Quantity Product" hint="Enter Quantity Product..."
            oldVal="{{ @$product->quantity }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <x-form.file name="image" label="Select Main Image Product" oldVal="{{ @$product->img_path }}"></x-form.file>
    </div>
    <div class="col-8">
        <x-form.fileMultiple name="galleries[]" label="Select Gallery Images Product"
            :oldVal="$product"></x-form.fileMultiple>
    </div>
</div>
