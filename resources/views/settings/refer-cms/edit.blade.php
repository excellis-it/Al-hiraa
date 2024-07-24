@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Refer Cms Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <!-- page-contain-start  -->
            <div class="integrations-div setting-profile-div">

                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Edit Refer Cms</h2>
                        </div>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="integrations-form profile-form">
                                <form action="{{ route('referral-cms.update') }}" method="POST" id="create-candidate" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $referCms->id }}">
                                    
                                    <div class="row g-2 justify-content-between auto-fill">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Small title <span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->main_title ?? '' }}" name="main_title" placeholder="">
                                                @if ($errors->has('main_title'))
                                                    <span class="text-danger">{{ $errors->first('main_title') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Small description <span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->small_description ?? '' }}" name="small_description" placeholder="">
                                                @if ($errors->has('small_description'))
                                                    <span class="text-danger">{{ $errors->first('small_description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Small description 2<span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->small_description2 ?? '' }}" name="small_description2" placeholder="">
                                                @if ($errors->has('small_description2'))
                                                    <span class="text-danger">{{ $errors->first('small_description2') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Image<span>*</span></label>
                                                <input type="file" class="form-control  uppercase-text" id=""
                                                     name="image" placeholder="">
                                                @if ($errors->has('image'))
                                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>

                                            <img src="{{  Storage::url($referCms->image) }}" alt="image" width="100px" height="100px">
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content1 Title<span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->content1_title ?? '' }}" name="content1_title" placeholder="">
                                                @if ($errors->has('content1_title'))
                                                    <span class="text-danger">{{ $errors->first('content1_title') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content1 Description<span>*</span></label>
                                                <input type="text" class="form-control uppercase-text" id=""
                                                    value="{{ $referCms->content1_description ?? '' }}" name="content1_description" placeholder="">
                                                @if ($errors->has('content1_description'))
                                                    <span class="text-danger">{{ $errors->first('content1_description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content1 Image<span>*</span></label>
                                                <input type="file" class="form-control  uppercase-text" id=""
                                                    name="content1_image" placeholder="">
                                                @if ($errors->has('content1_image'))
                                                    <span class="text-danger">{{ $errors->first('content1_image') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <img src="{{ Storage::url($referCms->content1_image) }}" alt="image" width="100px" height="100px">
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content2 Title<span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->content2_title ?? '' }}" name="content2_title" placeholder="">
                                                @if ($errors->has('content2_title'))
                                                    <span class="text-danger">{{ $errors->first('content2_title') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content2 Description<span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->content2_description ?? '' }}" name="content2_description" placeholder="">
                                                @if ($errors->has('content2_description'))
                                                    <span class="text-danger">{{ $errors->first('content2_description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content2 Image<span>*</span></label>
                                                <input type="file" class="form-control  uppercase-text" id=""
                                                    name="content2_image" placeholder="">
                                                @if ($errors->has('content2_image'))
                                                    <span class="text-danger">{{ $errors->first('content2_image') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{ Storage::url($referCms->content2_image) }}" alt="image" width="100px" height="100px">
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content3 Title<span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->content3_title ?? '' }}" name="content3_title" placeholder="">
                                                @if ($errors->has('content3_title'))
                                                    <span class="text-danger">{{ $errors->first('content3_title') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content3 Description<span>*</span></label>
                                                <input type="text" class="form-control  uppercase-text" id=""
                                                    value="{{ $referCms->content3_description ?? '' }}" name="content3_description" placeholder="">
                                                @if ($errors->has('content3_description'))
                                                    <span class="text-danger">{{ $errors->first('content3_description') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Content3 Image<span>*</span></label>
                                                <input type="file" class="form-control  uppercase-text" id=""
                                                    name="content3_image" placeholder="">
                                                @if ($errors->has('content3_image'))
                                                    <span class="text-danger">{{ $errors->first('content3_image') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{ Storage::url($referCms->content3_image) }}" alt="image" width="100px" height="100px">
                                        </div>     
                                    </div>

                                    <div class="row g-2 justify-content-between ">
                                        <div class="col-lg-12">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn">Update</button>
                                                <a href=""
                                                    class="btn save-btn save-btn-1">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
