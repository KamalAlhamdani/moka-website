{{-- JS Ajax for offer slider in main page --}}
<script>
    // console.log('Ajax offer data url: ' + '{{ route('website.offer.index') }}');

    // console.log("{{ app()->getLocale() }}");

    // console.log('Ajax offer data url: ' + '{{ route('website.offer.index') }}');
    // GET JSON FROM PHP SCRIPT
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '{{ route('website.offer.index') }}',
        headers: {
            "lang": "{{ app()->getLocale() }}",
        },
        success: function (data) {
            /* console.log('seccuss: ' + data["data"].data.length); */
            /* console.log('seccuss: ' + data["data"].data[0].name); */
            var mydata = Object.create(data["data"].data);
            /* console.log(mydata.length + ' mydate variable'); */
            for (var i = 0; i <= mydata.length; i++) {

                $('div.offer-slider').append(
                    '<div> Your Content '+mydata[i].name+' </div>'
                );
                $('div.offer-slider-stopped').append(

                    '<!-- === slide item === -->'+
                    '<div class="item" style="background-image:url(' +mydata[i].image_path + ')">'+
                    '<div class="box">'+
                    '<div class="container">'+
                    '<h2 class="title animated h1" data-animation="fadeInDown">'+mydata[i].name+'</h2>'+
                    '<div class="animated" data-animation="fadeInUp">'+
                    '<span class="borderd-text ">'+mydata[i].price+'</span>'+
                    '<span class="borderd-text h4">'+mydata[i].old_price+'</span>'+
                    '</div>'+
                    /* {{--<div class="animated" data-animation="fadeInUp">
                        <a href="#" target="_blank" class="btn btn-main" ><i class="icon icon-cart"></i> Browes Products</a>
                    </div>--}} */
                    '</div>'+
                    '</div>'+
                    '</div>'



                    /* +'<img loading="lazy" src="' +mydata[i].image_path + '" alt="" style="height: auto;max-height: 40px;width: auto;max-width: 100%; padding: 0px;" />' */

                );
            }

        },
        error: function (data) {
            /* console.log('failed'); */
        }
        /* error : errorHandler, */
    });
    $(document).ready(function(){
        $(".offer-slider").owlCarousel();
    });
</script>
