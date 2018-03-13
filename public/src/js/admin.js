

$.ajax({
    type: "GET",
    cache: false,
    /*data: {generic_id: generic_category_value},*/
    url: "http://localhost:8000/get_admin_chart_data",
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

    






        
   
