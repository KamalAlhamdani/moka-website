<!--Price-->
<style>
.irs-from, .irs-to {
    font-size: 11px;
}
</style>
{{-- TODO: make active when price selected --}}
<div class="filter-box active">
    <div class="title">{{__('_moka_home.price')}}</div>
    <div class="filter-content" dir="ltr">
        <div class="price-filter">
            <input type="text" id="range-price-slider" value="643646" name="range"
            data-type="double"
            {{-- TODO: Show lowest and heightest prices  --}}
            data-min="{{ $min_price }}"
            data-max="{{ $max_price }}"
            data-from="{{ $current_min_price }}"
            data-to="{{ $current_max_price }}"
            data-grid="true"
            />
        </div>
    </div>
</div>
