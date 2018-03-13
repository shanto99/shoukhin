$('input:radio[class="rate_radio"]').change(
    function(){
    	var rating = $(this).val();
    	var p_id = $("#hidden_id").val();
    	
    $.ajax({
        type: "GET",
        cache: false,
        data: {rating: rating, p_id: p_id},
        url: "http://localhost:8000/giving_rating",
        success: function (data) {
            alert(data);

        },
        error: function(error){
        	console.log(error);
        }

    });
       
    });


