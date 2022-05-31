$(document).ready(function(){

    fetchnumberboards();

    function fetchnumberboards(){

        $.ajax({
            type: "GET",
            url: "/fetch-numberboards",
            dataType: "json",
            success: function(response){
                //console.log(response.numberboards);
                $.each(response.numberboards, function (key, item) {
                    $('#numberboards').append(`
                        <option id="`+item.ID_Klant+`" value="`+item.kenteken+`">`+item.kenteken+`</option>
                    `)
                });
            }
        })

    }

});
