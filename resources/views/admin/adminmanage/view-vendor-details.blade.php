@extends('admin.layouts.master')
@section('content')
<div class="col-md-12 col-12">
    <div class="container">
        <h3 style="margin-left: 300px;">Vendor Details</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Personal Details</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                 {{--  Admin image  --}}
                <div class="modal fade text-left" id="imageModal" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{ url('admin/photo/' . $vendorDtls['image']) }}" alt="Image" style="height: 400px; width:470px;" >
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                     {{--  Address Proof image  --}}
                    <div class="modal fade text-left" id="addressModal" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{ url('admin/photo/' . $vendorDtls['image']) }}" alt="Image" style="height: 400px; width:470px;" >
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="mb-3 row">
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label for="metaname" class="text-end control-label col-form-label">Name :</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mt-2">
                                <div >{{$vendorDtls['name'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label for="metaname" class=" text-end control-label col-form-label">Type :</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mt-2">
                                <div >{{ $vendorDtls['type'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label for="metaname" class="text-end control-label col-form-label">Mobile :</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mt-2">
                                <div >{{$vendorDtls['mobile'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label for="metaname" class=" text-end control-label col-form-label">Image :</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mt-2">
                                <a href="#" data-bs-toggle="modal"
                                data-bs-target="#imageModal">{{ $vendorDtls['image'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label for="metaname" class="text-end control-label col-form-label">Email :</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mt-2">
                                <div >{{$vendorDtls['email'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label for="metaname" class=" text-end control-label col-form-label">Status :</label>
                            </div>
                            <div class="col-sm-6 col-md-6 mt-2">
                                @if ($vendorDtls['status'] == 0)
                                <div><label class="btn btn-danger btn-sm rounded-pill">{{ 'InActive' }}</label></div>
                            @elseif ($vendorDtls['status'] == 1)
                                <div><label class="btn btn-success btn-sm rounded-pill">{{ 'Active' }}</label></div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="card-header">
                    <h4 class="card-title">Shop Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Address :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_personal']['address'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">City :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_personal']['city'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">State :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_personal']['state'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Country :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_personal']['country'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="card-title">Business Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Shop Name :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_business']['shop_name'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Shop Address :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['shop_address'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Shop City :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_business']['shop_city'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Shop State :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['shop_state'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Shop Country :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_business']['shop_country'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Shop Pincode :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['shop_pincode'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Shop Email :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_business']['shop_email'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Shop Mobile :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['shop_mobile'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Shop Website :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_business']['shop_website'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Address Proof:</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['address_proof'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Address Proof Image :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#addressModal">{{$vendorDtls['vendor_business']['address_proof_image'] }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Business Liecence No :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['buisness_lincence_no'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">GST No :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_business']['gst_no'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">PanCard No :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_business']['pancard_no'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="card-title">Bank Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Bank Name :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_bank']['bank_name'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Bank Account No :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_bank']['bank_account_no'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class="text-end control-label col-form-label">Account Holder Name :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{$vendorDtls['vendor_bank']['account_holder_name'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <label for="metaname" class=" text-end control-label col-form-label">Bank IFSC Code :</label>
                                </div>
                                <div class="col-sm-6 col-md-6 mt-2">
                                    <div >{{ $vendorDtls['vendor_bank']['bank_ifsc_code'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 border-top">
                    <div class="text-end">
                        <a type="button" id="edit_btn"
                            class="btn btn-primary btn-sm rounded-pill" href="{{url('/admin/admin-management/vendor')}}">Close</a>
                        {{-- <button type="cancel" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">Cancel</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
