$(document).ready(function(){

    //checked welke class je moet gebruiken om te changen


    vmiddelnull();


    // checked welke gebruiker nog een transactie heeft waar eindtijd null is
    function vmiddelnull(){
        $.ajax({
            type: "GET",
            url: "/end-session",
            dataType: "json",
            success: function(response){
                $('#numberboards').on('change', function() {
                    $("#endsessionbutton").empty();
                    kenteken = this.value;
                    $.each(response.transactions, function (key, item) {
                        if(item.kenteken == kenteken){

        })
    }
    function checknumberboards(nullkenteken){

                            $('#endsessionbutton').append(`
                                <input name="eindtijd" type="hidden" value="`+new Date()+`">
                                <button class = "btn btn-primary ">Eindig sessie</button>
                            `)

                        }
                    });
                });

            }

        })
    }

});
