$(document).ready(function(){

    $('#customer').on('change', function() {
        $("#numberboards").empty();
        checknumberboard( this.value );
    });

    function checknumberboard(recieved){

        $.ajax({
            type: "GET",
            url: "/fetch-numberboards",
            dataType: "json",
            success: function(response){
                $('#numberboards').append(`
                <option value="" disabled selected>Selecteer Nummerbord</option>
                `)
                $.each(response.numberboards, function (key, item) {

                    if(item.kenteken == kenteken.eindtijd){

                        $('#numberboards').append(`
                            <option id="`+item.ID_Klant+`" value="`+item.kenteken+`">`+item.kenteken+`</option>
                        `)

                    }
                });
            }
        })

    }
});
