@extends('admin.layouts.master')
@section('content')
@if($slug == 'personal')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Vendor Personal Details</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
                </div>
                @endif
                <div class="modal fade" id="adminimage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src="{{ url("admin/photo/".Auth::guard('admin')->user()->image) }}" alt="Image" style="height: 400px; width:600px;" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form form-vertical" action="{{url('admin/update-vendor-details/personal') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Vendor Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Input with icon left" id="first-name-icon" value="{{ Auth::guard('admin')->user()->email }}" name="email">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Vendor Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Input with icon left" value="{{ Auth::guard('admin')->user()->name }}" name="name">
                                        @error('name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Address</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Name" value="{{ $vendorDtls['address'] }}" name="address" id="address">
                                        @error('address')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">City</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Input with icon left" value="{{ $vendorDtls['city'] }}" name="city" id="city">
                                        @error('city')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Country</label>
                                    <div class="position-relative">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->country_name }}" @if($country->country_name == $vendorDtls['country'])
                                                selected
                                            @endif>{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">State</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Input with icon left" value="{{ $vendorDtls['state'] }}" name="state" id="state">
                                        @error('state')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Pincode</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Input with icon left" value="{{ $vendorDtls['pincode'] }}" name="pincode" id="pincode">
                                            @error('pincode')
                                            <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="mobile-id-icon">Mobile</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Enter Your Mobile number" value="{{ Auth::guard('admin')->user()->mobile }}" name="mobile" maxlength="10" minlength="10">
                                            @error('mobile')
                                            <div style="color: red;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="mobile-id-icon">Image</label>
                                        <div class="position-relative">
                                            <input type="file" class="form-control" name="vendor_image">
                                            <input type="hidden" name="current_vendor_image" value="{{Auth::guard('admin')->user()->image}}">

                                            {{-- @error(image')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror --}}

                                    </div>
                                    @if(!empty(Auth::guard('admin')->user()->image))
                                    {{-- <a target="_blank" href="{{ url( "admin/photo/".Auth::guard('admin')->user()->image) }}" class="btn btn-info rounded-pill btn-sm">View Image</a> --}}
                                    <div class="col-sm-6 col-md-6 mt-2">
                                        <button type="button" class="btn btn-outline-info btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#adminimage">
                                            View Image
                                          </button>
                                    </div>
                                  @endif
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@elseif($slug == 'buisness')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Vendor Business Details</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
                </div>
                @endif
                <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src="{{ url('admin/proofs/' . $vendorDtls['address_proof_image']) }}" alt="Image" style="height: 400px; width:600px;" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form form-vertical" action="{{url('admin/update-vendor-details/buisness') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Vendor Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Input with icon left" id="first-name-icon" value="{{ Auth::guard('admin')->user()->email }}" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Shop Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter your Shop Name" value="{{ $vendorDtls['shop_name'] }}" name="shop_name">
                                        @error('shop_name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Shop Address</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Shop Address" value="{{ $vendorDtls['shop_address'] }}" name="shop_address">
                                        @error('shop_address')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Shop City</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter your Shop City" value="{{ $vendorDtls['shop_city'] }}" name="shop_city">
                                        @error('shop_city')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Shop State</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter your Shop State" value="{{ $vendorDtls['shop_state'] }}" name="shop_state">
                                        @error('shop_state')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Shop Country</label>
                                    <div class="position-relative">
                                        <select name="shop_country" id="shop_country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->country_name }}" @if($country->country_name == $vendorDtls['shop_country'])
                                                selected
                                            @endif>{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('shop_country')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Shop Pincode</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter your Shop Pincode" value="{{ $vendorDtls['shop_pincode'] }}" name="shop_pincode">
                                        @error('shop_pincode')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Shop Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter your Shop Email" value="{{ $vendorDtls['shop_email'] }}" name="shop_email">
                                        @error('shop_email')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Mobile</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Mobile number" value="{{ $vendorDtls['shop_mobile'] }}" name="shop_mobile" maxlength="10" minlength="10">
                                        @error('shop_mobile')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Business Lincence No.</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Business Lincence No." value="{{ $vendorDtls['buisness_lincence_no'] }}" name="buisness_lincence_no" id="buisness_lincence_no">
                                        @error('buisness_lincence_no')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">GST NO.</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Mobile number" value="{{ $vendorDtls['gst_no'] }}" name="gst_no" id="gst_no">
                                        @error('gst_no')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Pancard No.</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Mobile number" value="{{ $vendorDtls['pancard_no'] }}" name="pancard_no" id="pancard_no">
                                        @error('pancard_no')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Address Proof</label>
                                    <select name="address_proof" id="address_proof" class="form-control">
                                        <option value="">---Select---</option>
                                        <option value="Passport" @if($vendorDtls['address_proof'] == 'Passport')
                                          selected
                                        @endif>Passport</option>
                                        <option value="Aadhar Card"  @if($vendorDtls['address_proof'] == 'Aadhar Card')
                                        selected
                                      @endif>Aadhar Card</option>
                                        <option value="Driving Licence"  @if($vendorDtls['address_proof'] == 'Driving Licence')
                                        selected
                                      @endif>Driving Licence</option>
                                        <option value="Voting Card"  @if($vendorDtls['address_proof'] == 'Voting Card')
                                        selected
                                      @endif>Voting Card</option>
                                    </select>
                                    @error('address_proof')
                                    <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Address Proof Image</label>
                                    <div class="position-relative">
                                        <input type="file" class="form-control" name="address_proof_image">
                                        <input type="hidden" name="current_address_proof_image" value="{{$vendorDtls['address_proof_image']}}">
                                        @error('address_proof_image')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if(!empty($vendorDtls['address_proof_image']))
                                    <div class="col-sm-6 col-md-6 mt-2">
                                        <button type="button" class="btn btn-outline-info btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#addressModal">
                                            View Image
                                          </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@elseif($slug == 'bank')
<div class="col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Update Vendor Bank Details</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>{{ Session::get('success') }}
                </div>
                @endif
                <form class="form form-vertical" action="{{ url('admin/update-vendor-details/bank') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Vendor Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Input with icon left" id="first-name-icon" value="{{ Auth::guard('admin')->user()->email }}" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Account Holder Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Account Holder Name" value="{{ $vendorDtls['account_holder_name'] }}" name="account_holder_name">
                                        @error('account_holder_name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Bank Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Bank Name" value="{{ $vendorDtls['bank_name'] }}" name="bank_name">
                                        @error('bank_name')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">IFSC NO.</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your IFSC NO." value="{{  $vendorDtls['bank_ifsc_code']}}" name="bank_ifsc_code">
                                        @error('bank_ifsc_code')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">Account No.</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Enter Your Account No." value="{{  $vendorDtls['bank_account_no']}}" name="bank_account_no">
                                        @error('bank_account_no')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endif
@endsection
