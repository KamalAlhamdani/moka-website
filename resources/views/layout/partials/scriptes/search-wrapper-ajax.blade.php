<script>
    $(function () {
        /* TODO: delay for 500 ms to execute */
        $("#search").keyup(function () {
            $.ajax({
                type: "GET",
                url: "{{ route('search.products') }}",
                data: {
                    search: document.getElementById('search').value
                },
                fail: function(xhr, textStatus, errorThrown){
                    $("#search-products-result").fadeOut(0);
                    $("#search-products-result").empty();
                    $("#search-products-result")
                        .append(
                            'go'
                        )
                        .hide().fadeIn(0);
                },
                success: function(data) {
                    $("#search-products-result").fadeOut(0);
                    $("#search-products-result").empty();
                    Object.keys(data).map(function(objectKey, index) {
                        var value = data['data'];
                        if (value.length == 0) {
                            $("#search-products-result")
                            .append(
                                "<li class='text-center'><a href='#''><span class='name text-center'>"+
                                "{{__('_moka_nav.there_is_no_products')}}"+
                                "</span></a></li>"
                            )
                            .hide().fadeIn(0);
                        }
                        /* console.log('value: '+value[index].id); */
                        var is_new = !value[index]['is_new'] ?"": "{{ __('_moka_products.new') }}";
                        $("#search-products-result")
                        .append(
                            '<li><a href="{{ route("products.details", '') }}/'+value[index].id+'"><span class="id">'+
                            /* '<img loading="lazy" style="height: 80px" src="'+value[index].image150+'" alt="" />'+ */
                            '</span> <span class="name">'+value[index].name+
                            '</span>'
                            +'<span class="category"> '
                            +is_new
                            +' </span>'
                            /* +'<span class="category">'+value[index]['category']+'</span>' */
                            +'</a></li>'
                        )
                        /*.hide() */
                        .fadeIn(0);
                        /* Since null == undefined is true, the following statements will catch both null and undefined */
                        /* if (value == null || value.length == 0) {
                            $("#search-products-result")
                            .append(
                                '<li class="text-center"><a href="#" ><span class="name text-center">There is no data</span></a></li>'
                            )
                            .hide().fadeIn(500);
                        } */
                    });
                }
            });
        });
    });
</script>
