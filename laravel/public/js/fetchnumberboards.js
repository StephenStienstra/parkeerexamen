$(document).ready(function(){

    $('#costumer').on('change', function() {
        $("#numberboards").empty();
        fetchnumberboards( this.value );
    });

    function fetchnumberboards(recieved){
        console.log(recieved);

        $.ajax({
            type: "GET",
            url: "/fetch-numberboards",
            dataType: "json",
            success: function(response){
                //console.log(response.numberboards);
                $.each(response.numberboards, function (key, item) {

                    if(item.ID_Klant == recieved){

                        $('#numberboards').append(`
                            <option id="`+item.ID_Klant+`" value="`+item.kenteken+`">`+item.kenteken+`</option>
                        `)

                    }
                });
            }
        })

    }

});
