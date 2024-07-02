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
            <form action="{{ route('feeds.update', Crypt::encrypt($feed->id)) }}" method="POST"
                enctype="multipart/form-data" id="feed-edit-form">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">

                            <div class="row">
                                <div class="col-xl-12">
                                    <h4>Edit Feed</h4>
                                    <div class="form-group">
                                        <label for="">Title<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $feed->title }}" name="title" placeholder="">
                                            <span class="text-danger" id="title_msg"></span>
                                    </div>
                                </div>

                                {{-- image --}}
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" class="form-control" 
                                            placeholder="" name="image[]" multiple>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                {{-- show images --}}
                                @if (isset($feed->feedFiles) && count($feed->feedFiles) > 0)
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            @foreach ($feed->feedFiles as $image)
                                                <div class="image-area m-4" id="{{ $image->id }}">
                                                    <img src="{{ Storage::url($image->file_name) }}" alt="Preview" style="height:100px;weight:80px;">
                                                    <a class="remove-image" href="javascript:void(0);"
                                                        data-id="{{ $image->id }}"
                                                        style="display: inline;">&#215;</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Description<span>*</span></label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $feed->content }}</textarea>
                                        <span class="text-danger" id="description_msg"></span>
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
