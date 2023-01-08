$(document).ready(function(){
    $(".type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".gravity").not("." + optionValue).addClass('dn');
                $("." + optionValue).removeClass('dn');
            } else{
                $(".gravity").addClass('dn');
            }
        });
    });
});