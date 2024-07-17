@if (isset($edit))
    <style>
        .image-area {
            position: relative;
            width: 15%;
            /* background: #333; */
            display: inline;
        }

        .image-area img {
            max-width: 100%;
            height: auto;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }
    </style>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('referral-points.update', $referral_point->id) }}" method="POST"
                enctype="multipart/form-data" id="referral-points-edit-form">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">

                            <div class="row">
                                <div class="col-xl-12">
                                    <h4>Edit Referral Point</h4>
                                    <div class="form-group">
                                        <label for="">Point<span>*</span></label>
                                        <input type="text" class="form-control" value="{{ $referral_point->point }}" name="point" >
                                            <span class="text-danger" id="title_msg"></span>
                                    </div>
                                </div>

                                {{-- image --}}
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input type="text" class="form-control" name="amount" value="{{ $referral_point->amount }}">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <div class="save-btn-div d-flex align-items-center">
                                        <button type="submit" class="btn save-btn"><span><i
                                                    class="fa-solid fa-check"></i></span> Update</button>
                                        <button type="button" class="btn save-btn save-btn-1 close-btn-edit"><span><i
                                                    class="fa-solid fa-xmark"></i></span>Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
