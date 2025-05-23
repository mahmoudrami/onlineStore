<div class="row">
  @foreach ($locales as $locale)
  <div class="col-6">
    <x-form.input type="text" name="name_{{ $locale }}" label="Enter {{ __($locale) }} Name Product"
      hint="Enter {{ __('en') }} Name Product..." oldVal="{{ @$product->name }}"></x-form.input>
  </div>
  @endforeach
</div>

<div class="row">
  @foreach ($locales as $locale)
  <div class="col-6">
    <x-form.area name="description_{{ $locale }}" label="Enter {{ __($locale) }} Name Product"
      hint="Enter {{ __('en') }} Name Product..." oldVal="{{ @$product->description }}"></x-form.area>
  </div>
  @endforeach
</div>



<div class="row">
  <div class="col-4">
    <x-form.file name="image" label="Select Main Image Product" oldVal="{{ @$product->img_path }}"></x-form.file>
  </div>
  <div class="col-8">
    <x-form.fileMultiple name="galleries[]" label="Select Gallery Images Product" :oldVal="@$product">
    </x-form.fileMultiple>
  </div>
</div>

<div class="row">
  <div class="col-4">
    <x-form.input type="number" name="price" label="Enter Price Product" hint="Enter Price Product..."
      oldVal="{{ @$product->price }}"></x-form.input>
  </div>
  <div class="col-4">
    <x-form.input type="number" name="quantity" label="Enter Quantity Product" hint="Enter Quantity Product..."
      oldVal="{{ @$product->quantity }}"></x-form.input>
  </div>
  <div class="col-4">
    <x-form.select name="category_id" label="Select Category Product" hint="Select Category Product..."
      oldVal="{{ @$product->quantity }}" oldVal="{{ @$product->category_id }}" :items=$categories></x-form.select>
  </div>
</div>

<div class="row">
  <div class="col-4">
    <x-form.select name="supplier_id" label="Select Supplier Product" hint="Select Supplier Product..."
      oldVal="{{ @$product->supplier_id }}" oldVal="{{ @$product->supplier_id }}" :items=$suppliers></x-form.select>
  </div>
</div>

@if (!isset($product))
@foreach ($attributes as $attribute)
<div class="row">
  <div class="col-9">
    <div class="mb-3">
      <div>
        <label for="{{ $attribute->name }}">{{ $attribute->translate('en')->name }}</label>
        <input type="checkbox" name="{{ $attribute->name }}" class="form-checkbox mx-3"
          id="CheckBox-{{ $attribute->id }}" value="{{ $attribute->id }}" @checked(old($attribute->name))>
      </div>
      <div class="d-none" id="tableAttribute-{{ $attribute->id }}">
        <table class="table bg-white table-bordered">
          <thead>
            <tr>
              @foreach ($locales as $locale)
              <th>name {{ __($locale) }}</th>
              @endforeach
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @php
            $rowCount = max(count(old("attributeValue.{$attribute->name}.{$locale}", [])), 1);
            @endphp

            @for ($i = 0; $i < $rowCount; $i++) <tr>
              @foreach ($locales as $locale)
              <td><input type="text" name="attributeValue[{{ $attribute->name }}][{{ $locale }}][]" class="form-control"
                  value="{{ old("attributeValue.{$attribute->name}.{$locale}.{$i}") }}">
              </td>
              @endforeach
              <td><button onclick="deleteRow(event)" class="btn" style="color: rgb(164, 96, 96)">X</button></td>
              </tr>
              @endfor
          </tbody>
        </table>
        @if ($attribute->is_multiple)
        <button class="btn btn-primary" onclick="addRow(event)"><i class="fas fa-plus"></i></button>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach
@else
<h1>Edit</h1>
@foreach ($attributes as $attribute)
<div class="row">
  <div class="col-9">
    <div class="mb-3">
      <div>
        <label for="{{ $attribute->name }}">{{ $attribute->translate('en')->name }}</label>
        {{-- @dd(array_key_exists($attribute->name, $attributesProduct)) --}}
        <input type="checkbox" name="{{ $attribute->name }}" class="form-checkbox mx-3"
          id="CheckBox-{{ $attribute->id }}" value="{{ $attribute->id }}" @checked(old($attribute->name) ||
        array_key_exists($attribute->name, $attributesProduct))>
      </div>
      <div class="d-none" id="tableAttribute-{{ $attribute->id }}">
        <table class="table bg-white table-bordered">
          <thead>
            <tr>
              @foreach ($locales as $locale)
              <th>name {{ __($locale) }}</th>
              @endforeach
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @php
            $rowCount = max(count(old("attributeValue.{$attribute->name}.{$locale}", [])), 0);
            @endphp

            @if (array_key_exists($attribute->name, $attributesProduct))
            @if ($rowCount == 0)
            @forelse ($attributesProduct[$attribute->name]['en'] as $one)
            <tr>
              @foreach ($locales as $locale)
              <td>
                <input type="text" name="attributeValue[{{ $attribute->name }}][{{ $locale }}][]" class="form-control"
                  value="{{ $one }}">
              </td>
              @endforeach
              <td><button onclick="deleteRow(event)" class="btn" style="color: rgb(164, 96, 96)">X</button>
                from data</td>
            </tr>
            @empty
            <tr>
              @foreach ($locales as $locale)
              <td>
                <input type="text" name="attributeValue[{{ $attribute->name }}][{{ $locale }}][]" class="form-control">
              </td>
              @endforeach
              <td><button onclick="deleteRow(event)" class="btn" style="color: rgb(164, 96, 96)">X</button>
                from data</td>
            </tr>
            @endforelse
            @endif
            @else
            <tr>
              @foreach ($locales as $locale)
              <td>
                <input type="text" name="attributeValue[{{ $attribute->name }}][{{ $locale }}][]" class="form-control">
              </td>
              @endforeach
              <td><button onclick="deleteRow(event)" class="btn" style="color: rgb(164, 96, 96)">X</button>
                from data</td>
            </tr>
            @endif

            @for ($i = 0; $i < $rowCount; $i++) <tr>
              @foreach ($locales as $locale)
              <td>
                <input type="text" name="attributeValue[{{ $attribute->name }}][{{ $locale }}][]" class="form-control"
                  value="{{ old("attributeValue.{$attribute->name}.{$locale}.{$i}") }}">
              </td>
              @endforeach
              <td><button onclick="deleteRow(event)" class="btn" style="color: rgb(164, 96, 96)">X</button>
                from validation</td>
              </tr>
              @endfor
          </tbody>
        </table>
        @if ($attribute->is_multiple)
        <button class="btn btn-primary" onclick="addRow(event)"><i class="fas fa-plus"></i></button>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach

@endif