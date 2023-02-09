

<form action="{{url('admin/product/hotfix', [$productId])}}" method="post">
    @csrf
    @foreach ($specfications as $specfication)
    <div class="show-{{$specfication->category_id}} mb-1 ms-2 show-spec"
        style="display: block">
        <label class="form-label fs-6 fw-bolder" for="basic-addon-name1">
            {{$specfication->specification_name}}
        </label>

        <input type="text" id="basic-addon-name1" class="form-control"
            placeholder="Nhập thông số sản phẩm" name="{{$specfication->id}}_value"
            aria-label="Name" aria-describedby="basic-addon-name" required />
    </div>
@endforeach
    <button type="submit">Submit</button>
</form>