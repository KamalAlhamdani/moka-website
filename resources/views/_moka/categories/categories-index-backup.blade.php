<script>
    $(document).ready(function () {
        $("span.description").click(function () {
            console.log('div span is click');
        });
    });

    console.log('Ajax data url: ' + '{{ route('website.category.index') }}');
    console.log("{{ app()->getLocale() }}");
    console.log('Ajax data url: ' + '{{ route('website.category.index') }}');
    /* GET JSON FROM PHP SCRIPT */
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '{{ route('website.category.index') }}',
        {{--                url : '{{ route('website.suggestion.index') }}',--}}
        headers: {
            "lang": "{{ app()->getLocale() }}",
        },
        success: function (data) {
            /* alert("goooooo" +': '+data["data"][1].name); */
            console.log('seccuss: ' + data["data"].length);
            console.log('seccuss: ' + data.data[0].details);
            var mydata = Object.create(data["data"]);
            console.log('length: ' + mydata.length);
            /* console.log(mydata[0].name); */
            for (var i = 0; i <= mydata.length; i++) {
                /* console.log(mydata[i].name); */
                /* console.log(mydata[i].name + ' ; ' + mydata[i].details + ' ; ' + mydata[i].image); */

                /* TODO: fix small screens issue */
                $('div.categories-items').append(
                    '<div class="col-md-4 col-sm-6 col-xs-12">' +
                    '<article>' +
                    '<div class="figure-block">' +
                    '<div class="image">' +
                    '<a class="text-center" href="' + '{{url("products")}}' + '?category_id='+mydata[i].id+'" style="min-width: 360px;min-height: 270px;">' +
                    '<img loading="lazy" src="' + '{!! domainAsset("'+mydata[i].image+'")!!}' + '" alt="" width="360" style="height: auto;max-height: 270px;width: auto;max-width: 360px; padding: 0px;" />' +
                    '</a>' +
                    '</div>' +
                    '<div class="text">' +
                    '<h2 class="title h4 text-center"><a href="' + '{{url("products")}}' + '">' + mydata[i].name + '</a></h2>' +
                    /* '<sup>Category description</sup>' + */
                    /* TODO: if needed display category details here */
                    /* '<span class="description clearfix">' + mydata[i].details + '</span>' + */
                    '</div>' +
                    '</div>' +
                    '</article>' +
                    '</div>'
                );
            }
            if (!data.error) {

            }
        },
        error: function (data) {
            console.log('faild');
        }
        /* error : errorHandler, */
    });
</script>
