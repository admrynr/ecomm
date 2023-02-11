$(document).ready(function(){
    $('.verify').on('click', function(){
        var name = $(this).data("name");
        var userid = $(this).data("id");
        var baseURL = window.location.origin;
        $( "#namecustomer" ).text(name);
        $("#btncustomer").on('click', function(){
            $.ajax({  async: true, method: "GET", url: baseURL+"/verify/"+userid, success: function(html){
                //alert(name+" Succesfully Changed!");
                $( ".tabled" ).append(html);
        }});
        
        //$( "#btncustomer" ).attr("href", "/verify/"+userid);
        });
    });
});