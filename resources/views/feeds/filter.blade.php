@if (count($feeds) > 0)
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-5">
    @foreach ($feeds as $feed)
        <div class="col mb-4">
            <div class="food-box">
                
                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Title:</h4>
                    </div>
                    <div class="food-status-2">
                        <h4>{{ $feed->title ?? 'N/A' }}</h4>
                    </div>
                </div>

                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Content:</h4>
                    </div>
                    <div class="food-status-2 company_address">
                        <h4>{{ Str::limit($feed->content) ?? 'N/A' }}</h4>
                    </div>
                </div>

                <div class="food-status">
                    <div class="food-status-1">
                        <h4>File Upload</h4>
                    </div>
                    <div class="food-status-2">
                        <h4>{{ $feed->created_at ?? 'N/A' }}</h4>
                    </div>
                </div>
                
                <div class="">
                    <a href="{{route('feeds.edit', Crypt::encrypt($feed->id))}}" class="btn-2">See Open Feeds</a>
                </div>
            </div>
        </div>
    @endforeach
    {{-- pagination --}}
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-center">
            {{ $feeds->links() }}
        </div>
    </div>
</div>
@else
{{-- no data found --}}
<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-center">
            <h3>No Data Found</h3>
        </div>
    </div>
</div>
@endif
