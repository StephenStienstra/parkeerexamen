$(document).ready(function(){

    var userid;

    $('#customer').on('change', function() {
        $("#endsessionbutton").empty();
        userid = this.value;
        vmiddelnull();
    });

    var test = "test";
    vmiddelnull();

    function vmiddelnull(){
        $.ajax({
            type: "GET",
            url: "/end-session",
            dataType: "json",
            success: function(response){
                $.each(response.transactions, function (key, item) {
                    if(item.eindtijd == null){
                        checknumberboards(item);
                    }
                });
            }

        })
    }
    function checknumberboards(nullkenteken){

        $.ajax({
            type: "GET",
            url: "/fetch-numberboards",
            dataType: "json",
            success: function(response){
                $.each(response.numberboards, function (key, item) {
                    if(item.kenteken == nullkenteken.kenteken){
                        console.log(item);




                    }
                });


            }
        })

    }
});
