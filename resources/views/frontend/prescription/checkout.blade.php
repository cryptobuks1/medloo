@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">


        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form class="form-default" data-toggle="validator"
                              action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                            @csrf
                            @if(Auth::check())
                                <div class="row gutters-5">
                                    @foreach (Auth::user()->addresses as $key => $address)
                                        <div class="col-md-6">
                                            <label class="aiz-megabox d-block bg-white">
                                                <input type="radio" name="address_id" value="{{ $address->id }}"
                                                       @if ($address->set_default)
                                                       checked
                                                       @endif required>
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                        <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                        <span class="flex-grow-1 pl-3">
                                                            <div>
                                                                <span class="alpha-6">Address:</span>
                                                                <span
                                                                    class="strong-600 ml-2">{{ $address->address }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">Postal Code:</span>
                                                                <span
                                                                    class="strong-600 ml-2">{{ $address->postal_code }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">City:</span>
                                                                <span
                                                                    class="strong-600 ml-2">{{ $address->city }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">Country:</span>
                                                                <span
                                                                    class="strong-600 ml-2">{{ $address->country }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">Phone:</span>
                                                                <span
                                                                    class="strong-600 ml-2">{{ $address->phone }}</span>
                                                            </div>
                                                        </span>
                                                    </span>
                                            </label>
                                        </div>
                                    @endforeach
                                    <input type="hidden" name="checkout_type" value="logged">
                                    <div class="col-md-6 mx-auto" onclick="add_new_address()">
                                        <div class="border p-3 rounded mb-3 c-pointer text-center bg-white">
                                            <i class="la la-plus la-2x"></i>
                                            <div class="alpha-7">Add New Address</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Name')}}</label>
                                                    <input type="text" class="form-control" name="name"
                                                           placeholder="{{__('Name')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="text" class="form-control" name="email"
                                                           placeholder="{{__('Email')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address')}}</label>
                                                    <input type="text" class="form-control" name="address"
                                                           placeholder="{{__('Address')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your country')}}</label>
                                                    <select class="form-control custome-control" data-live-search="true"
                                                            name="country">
                                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                            <option
                                                                value="{{ $country->name }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{__('City')}}"
                                                           name="city" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="number" min="0" class="form-control"
                                                           placeholder="{{__('Postal code')}}" name="postal_code"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input type="number" min="0" class="form-control"
                                                           placeholder="{{__('Phone')}}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="checkout_type" value="guest">
                                    </div>
                                </div>
                            @endif
                            <div class="row align-items-center pt-4">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit"
                                            class="btn btn-styled btn-base-1">PLACE ORDER</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">

                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('New Address')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Address')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea class="form-control textarea-autogrow mb-3"
                                              placeholder="{{__('Your Address')}}" rows="1" name="address"
                                              required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Country')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <select class="form-control mb-3 selectpicker"
                                                data-placeholder="{{__('Select your country')}}" name="country"
                                                required>
                                            @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('City')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="{{__('Your City')}}"
                                           name="city" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Postal code')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3"
                                           placeholder="{{__('Your Postal Code')}}" name="postal_code" value=""
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>{{__('Phone')}}</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="{{__('+880')}}"
                                           name="phone" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-base-1">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function add_new_address() {
            $('#new-address-modal').modal('show');
        }
    </script>
@endsection
