$(document).ready(function () {
    $('#page_div').hide();
    $('.instruct').hide(); //hide
    $('#search_field').focus(function(){
        $('.instruct').show(); //show
    }).blur(function(){
        $('.instruct').hide(); //hide again
    });
    $('#make_fb_post').click(function() {
        if( $(this).is(':checked')) {
            $("#page_div").show();
        } else {
            $("#page_div").hide();
        }
    });
    $("#main_category").change(function () {
        var main_category = document.getElementById("main_category");
        var main_category_value = main_category.options[main_category.selectedIndex].value;
        
        $.ajax({
            type: "GET",
            cache: false,
            data: {main_cat_id: main_category_value},
            url: "http://localhost:8000/get_generic_category",
            success: function (data) {
                
                var generic_category_select = $("#generic_category");
                generic_category_select.empty();
                generic_category_select.append("<option selected disabled>Select a sub category</option>");
                for(var i in data){
                    generic_category_select.append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                }
            }
        })
    });
    $("#generic_category").change(function () {
        var generic_category_select = document.getElementById("generic_category");
        var generic_category_value = generic_category_select.options[generic_category_select.selectedIndex].value;
        
        $.ajax({
            type: "GET",
            cache: false,
            data: {generic_id: generic_category_value},
            url: "http://localhost:8000/get_sub_category",
            success: function (data) {
                //alert()
                var sub_category_select = $("#sub_category");
                sub_category_select.empty();
                sub_category_select.append("<option selected disabled>Select a sub category</option>");
                for(var i in data){
                    sub_category_select.append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                }
            }

        })
    });
})