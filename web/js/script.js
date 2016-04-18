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
				   url: 'index.php/search/'+valeur,
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

		// --------------------------- SCRIPT AJAX FAVORIS -------------------------------- 

		$(document).on("click",".result-favorite-link",function(e)
		{
			e.preventDefault();
			if($(this).children().attr("class")=="fa fa-star-o")
			{
				$(this).html("<i class=\"fa fa-star\"></i>");	
			}
			else
			{
				$(this).html("<i class=\"fa fa-star-o\"></i>");
			}
				$.ajax({
				   url: $(this).attr("href"),
				   type: 'GET',
				   success: function(data) {
				   }
				 });
		});

		// --------------------------- SCRIPT AJAX CLICS / VIEW -------------------------------- 

		$('.result-container').on("click","a",function(e)
		{
			var id = $(this).closest(".result-container").attr("id");
			var id_site = id.substring(id.length,id.length-1);
			$.ajax({
				   url: "index.php/inc/"+id_site,
				   type: 'GET',
				   success: function(data) {
				   }
				 });
		});
});