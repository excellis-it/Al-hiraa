@extends('layouts.master')
@section('title')
    {{env('APP_NAME')}} - Socail Media
@endsection
@push('styles')
@endpush
@section('content')
<div class="mdk-drawer-layout__content page">
    <div class="container-fluid page__heading-container">
        <!-- page-contain-start  -->
        <div class="integrations-div">
            <div class="integrations-head">
                <h2>Integrations</h2>
            </div>
            <div class="integrations-form-div">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="integrations-form-box">
                            <div class="integrations-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/whatsapp.png')}}" alt="">
                                <h3>WhatsApp</h3>
                            </div>
                            <div class="integrations-form">
                                <form>
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">WhatsApp Number with Country Code</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Secret Key</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="save-btn-div d-flex align-items-center">
                                            <a href="" class="btn save-btn">save</a>
                                            <a href="" class="btn save-btn save-btn-1">Reset</a>
                                          </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="integrations-form-box">
                            <div class="integrations-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/email.png')}}" alt="">
                                <h3>Email</h3>
                            </div>
                            <div class="integrations-form">
                                <form>
                                    <div class="row g-2">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Website</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="save-btn-div d-flex align-items-center">
                                            <a href="" class="btn save-btn">save</a>
                                            <a href="" class="btn save-btn save-btn-1">Reset</a>
                                          </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-contain-end  -->
    </div>
</div>
@endsection

@push('scripts')

@endpush
