{{-- JS Ajax for navbar --}}
<script>
    /* window.onload = function() { */
    /* }; */
    {{--console.log('Ajax data url: ' + '{{ route('website.category.index') }}');--}}
    /* GET JSON FROM PHP SCRIPT */
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '{{ route('website.category.index') }}',
        headers: {
            "lang": "{{ app()->getLocale() }}",
        },
        success: function (data) {
            var mydata = Object.create(data["data"]);
            for (var i = 0; i <= mydata.length; i++) {
                $('div.categories-nav').append(
                    '<div class="col-sm-4 col-xs-6">' +
                    '<a  href="{{route("products")}}?category_id='+mydata[i].id+'">' +
                    '<figure>' +
                    /* '<i class="f-icon moka-'+mydata[i].name+'-xx-large"></i>'+ */
                    '<img loading="lazy" src="' + '{!! asset("'+mydata[i].image+'")!!}' + '" alt="" style="height: auto;max-height: 40px;width: auto;max-width: 100%; padding: 0px;" />' +
                    '<figcaption>' + mydata[i].name + '</figcaption>' +
                    '</figure>' +
                    '</a>' +
                    '</div>'
                );
            }
            if (!data.error) {
                $('div.categories-navz').append(
                    '<div class="col-sm-4 col-xs-6">' +
                    '<form id="nav-product-form" action="{{ route("products") }}'+'" method="POST" style="display: none;">'+
                    '@csrf'+
                    '<input id="category_id" type="hidden" name="' + mydata[i].id + '">'+
                    '</form>'+
                    '<a  href="{{route("products")}}" onclick="event.preventDefault();document.getElementById(\'nav-product-form\').submit();">' +
                    '<button type="button" form="nav-product-form" class="btn btn-block btn-main">'+
                    '<figure>' +
                    /* '<i class="f-icon moka-'+mydata[i].name+'-xx-large"></i>'+ */
                    '<img loading="lazy" src="' + '{!! asset("'+mydata[i].image+'")!!}' + '" alt="" style="height: auto;max-height: 40px;width: auto;max-width: 100%; padding: 0px;" />' +
                    '<figcaption>' + mydata[i].name + '</figcaption>' +
                    '</figure>' +
                    '</button>'+
                    '</a>' +
                    '</div>'
                );
                /* TODO: delete this after get working with new nav data with form */
                $('div.categories-navzz').append(
                '<div class="col-sm-4 col-xs-6">' +
                ' '+
                '<a href="{{route("products.details",'')}}/'+mydata[i].id +'">' +

                '<figure>' +
                /* '<i class="f-icon moka-'+mydata[i].name+'-xx-large"></i>'+ */
                '<img loading="lazy" src="' + '{!! asset("'+mydata[i].image+'")!!}' + '" alt="" style="height: auto;max-height: 40px;width: auto;max-width: 100%; padding: 0px;" />' +
                '<figcaption>' + mydata[i].name + '</figcaption>' +
                '</figure>' +
                '</a>' +
                '</div>'
                );
            }
        },
        error: function (data) {
            console.log('Categories failed to be retrieved');
        }
        /* error : errorHandler, */
    });

</script>
