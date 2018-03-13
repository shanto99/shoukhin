$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lan: position.coords.longitude
            };
            $('#lat_field').val(pos.lat);
            $('#lang_field').val(pos.lan)
        });

    }
})