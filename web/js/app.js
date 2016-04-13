$(document).ready(function() {


      $("#categories ul li").hover(function() {

      if($(this).children().is(":visible") == true)
      {
        $(this).children().hide();
      }
      else
      {
        $(this).children().show();
      }

  });


  $(".plus-description").click(function(e){

    e.preventDefault();
    var code="<input type=\"text\" name=\"descriptions[]\"> &nbsp <input type=\"text\" name=\"values[]\"> </br> </br>";
    $(this).parent().append(code);
     
  });

   $(document).on('click','.less-date',function(e){

    e.preventDefault();
    $(this).parent().remove();
     
  });

   $(".work-checkbox").change(function() {
    if(this.checked){
       $(this).parent().next("#bloc_input").show();
    }
    else
    {
       $(this).parent().next("#bloc_input").hide();
    }
});

$(document).on('click','.less-date',function(e){

    e.preventDefault();
    $(this).parent().remove();
     
  });

$(document).on('click','.open-user-menu',function(e){

    e.preventDefault();
    if($("#user_header").is(":visible"))
    {
      $("#user_header").fadeOut(500);
    }
    else
    {
      $("#user_header").fadeIn(500);
    }
    
     
  });

});
