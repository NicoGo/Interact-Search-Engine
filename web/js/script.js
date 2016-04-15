$( document ).ready(function() {

		$("#result-container a").each(function()
		{
			var url = $(this).attr("href");
			var obj = $(this);
		});

		$(".search").keyup(function()
		{

			var valeur = $(this).val();
			if(valeur!="")
			{
				$.ajax({
				   url: '../index.php/search/'+valeur,
				   type: 'GET',
				   success: function(data) {
				      $(".all-results").empty();
				      $(".all-results").append(data);
				}	
			});
			}
			else
			{
				$.ajax({
				   url: '../index.php/search',
				   type: 'GET',
				   success: function(data) {
				      $(".all-results").empty();
				      $(".all-results").append(data);
					}
				});	
			}  
		});

		$(".enable").click(function()
		{
			$(".link-disable").each(function()
			{
				$(this).css("display","none");
			});
		});

		// --------------------------- SCRIPT AJAX FAVORIS -------------------------------- **/ 

		$(".result-favorite-link").click(function(event)
		{
			event.preventDefault();
			if($(this).children().attr("class")=="fa fa-star-o")
			{
				$(this).html("<i class=\"fa fa-star\"></i>");
			}
			else
			{
				$(this).html("<i class=\"fa fa-star-o\"></i>");
			}
		});

});