
function getRecord() {

    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();


    $.ajax({
        type: "GET",
        cache: false,
        data: {from_date: from_date, to_date: to_date},
        url: "http://localhost:8000/get_desired_chart",
        success: function (data) {
            console.log(data);
            $("#bar-example").empty();
            createMoris(data);

        }

    });
}

$.ajax({
    type: "GET",
    cache: false,
    /*data: {generic_id: generic_category_value},*/
    url: "http://localhost:8000/get_chart_data",
    success: function (data) {
        console.log(data);
        createMoris(data);
    }

});




function createMoris(data){

    var myMorris = Morris.Area({
        element: 'bar-example',
        data: data,
        xkey: 'dates',
        ykeys: ['total'],
        labels: ['Total Sell']
    });
    $(document).ready(function () {
        $('#myTable').dataTable();
    });

    



}
$('#add_to_gyd').click(function (){
    var p_id = $('#p_id').val();
    var ft_qty = $('#ft_qty').val();
    var ft_price = $('#ft_price').val();
    var st_qty = $('#st_qty').val();
    var st_price = $('#st_price').val();
    if(ft_qty.length<=0 || ft_price.length <= 0 || st_qty.length <= 0 || st_price <= 0){
        alert('All field must be filled up!!!');
    }
    else{
         $.ajax({
        type: "GET",
        cache: false,
        data: {p_id: p_id, ft_qty: ft_qty, ft_price: ft_price, st_qty: st_qty, st_price: st_price},
        url: "http://localhost:8000/add_to_gyd",
        success: function (data) {
            
            alert(data);
            $('.closebtn'+p_id).click();
            $('#btn'+p_id).prop("disabled",true);

        }

    });
    }
});
