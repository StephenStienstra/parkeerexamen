$(document).ready(function(){

    $('#customer').on('change', function() {

    });

    endsession();

    function endsession(){

        $.ajax({
            type: "GET",
            url: "/end-session",
            dataType: "json",
            success: function(response){
                $.each(response.transactions, function (key, item) {
                    if(item.eindtijd == null){
                        console.log(item);
                    }


                    // if(item.eindtijd == isNull){
                    //     return(response.transactions);
                    // }

                });
            }
        })

    }

});
