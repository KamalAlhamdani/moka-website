@foreach($categories as $category)
<div class="col-sm-3 col-xs-6">
    <a  href="{{route("products")}}?category_id={{ $category->id }}">
        <figure>{{-- TODO: fix max-width --}}
            <img loading="lazy" src="{{ domainAsset( $category->image ) }}" alt="" style="height: auto;max-height: 40px;width: auto;max-width: 100%; padding: 0px;"
                 onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';"/>
            <figcaption>{{ $category->name }}</figcaption>
        </figure>
    </a>
</div>
@endforeach
