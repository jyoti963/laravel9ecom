@extends('admin.layouts.master')
@section('content')
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3>Categories</h3>
                <h4 class="card-title">Add Attributes</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('delete'))
                        <div class="alert alert-danger"><i class="bi bi-file-excel"></i>{{ Session::get('delete') }}
                        </div>
                    @endif
                    <form class="form form-vertical" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Product Name :</label>
                                        <div class="col-md-6 col-sm-6 mt-2">
                                            {{ $product['product_name'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Product Code :</label>
                                        <div class="col-md-6 col-sm-6 mt-2">
                                            {{ $product['product_code'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Product Color</label>
                                        <div class="col-md-6 col-sm-6 mt-2">
                                            {{ $product['product_color'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Product Price</label>
                                        <div class="col-md-6 col-sm-6 mt-2">
                                            {{ $product['product_price'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="mobile-id-icon">Product Image :</label>
                                        <div class="col-md-6 col-sm-6 mt-2">
                                            @if (!empty($product['product_image']))
                                                <img style="width: 120px"
                                                    src="{{ url('admin/image/product_images/large/' . $product['product_image']) }}" />
                                        </div>
                                    @else
                                        <img style="width: 120px"
                                            src="{{ url('admin/image/product_images/small/NoImageAvailable.png') }}" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div>
                                                <input type="text" name="size[]" style="width: 120px;"
                                                    placeholder="Size" required />
                                                <input type="text" name="sku[]" style="width: 120px;" placeholder="SKU"
                                                    required />
                                                <input type="text" name="price[]" style="width: 120px;"
                                                    placeholder="Price" required />
                                                <input type="text" name="stock[]" style="width: 120px;"
                                                    placeholder="Stock" required />
                                                <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-header">
            <h4 class="card-title">Product Attributes</h4>
        </div>
        <form class="form form-vertical" action="{{ url('admin/edit-attributes/' . $product['id']) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body mt-2">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Size</th>
                                <th>SKU</th>
                                <th>Price </th>
                                <th>Stock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  <?php $number = 1; ?>  --}}
                            @foreach ($product['attribute'] as $attribute)
                                <input type="text" value="{{ $attribute['id'] }}" name="attributeId[]"
                                    style="display: none;">
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $attribute['size'] }}</td>
                                    <td>{{ $attribute['sku'] }}</td>
                                    <td><input type="text" value="{{ $attribute['price'] }}" name="price[]"
                                            style="width:70px;" required></td>
                                    <td><input type="text" value="{{ $attribute['stock'] }}" name="stock[]"
                                            style="width:70px;" required></td>
                                    <td>
                                        @if ($attribute['status'] == '1')
                                            <div class="form-check form-switch">
                                                <a href="javascript:void(0)" class="updateattributeStatus"
                                                    id="attribute-{{ $attribute['id'] }}"
                                                    attribute_id="{{ $attribute['id'] }}">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" status="Active " checked>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Active</label>

                                                </a>
                                            </div>
                                        @elseif ($attribute['status'] == '0')
                                            <div class="form-check form-switch">
                                                <a href="javascript:void(0)" class="updateattributeStatus"
                                                    id="attribute-{{ $attribute['id'] }}"
                                                    attribute_id="{{ $attribute['id'] }}">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" status="Inactive">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Inactive</label>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                {{--  <?php $number++; ?>  --}}
                            @endforeach

                        </tbody>
                    </table>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection
