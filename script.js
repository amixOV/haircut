
 $(document).ready(function(){
 
		 $(".buttonRegOrEnter").click(function(){
			 $(".enter").toggle(500);
			 $(".registration").toggle(500);
		 });

		
		$(".button_detail").click(function(){
			$(this).children(".hidden_detail").toggle(500);
		 });

		 $(".button_messege").click(function(){
			$(".tor_messeges").toggle(500);
			$(".button_messege").text(($(".button_messege").text() == 'יש לך תור') ? 'X' : 'יש לך תור').fadeIn();
		 });

		 $(".button_admin_table").click(function(){
			$(".table_admin_DB").toggle(500);
			$(".button_admin_table").text(($(".button_messege").text() == 'פרטים') ? 'X' : 'פרטים').fadeIn();
		 });
		
		$(".butt on_table_admin").click(function(){
			$(".table_admin_DB").slidedown(500);
		 });
		
		
		//$(".form").bind('ajax:complete', function() {
		//	$(".table_for_admin").show(500);
		//	$('.table_for_admin').css('display','block');
         // tasks to do 

		 $(".for m").submit(function(e) {
		 	$('.table_for_admin').css('display','block');
        
    	 });
  		window.onload = function() {
			$('.progress').css('display','none');
			//$('html').css('background-color','#00138600')
		};
  	/*	function showProgress() {
		  $('.form').hide();
		  $('.progress').fadeIn("slow");
		}

		  $('.progress').hide();        //hide gif on page load    
		  $('.button_table_admin').on('click', showProgress); //and show it after clicking your button
*/
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".table_admin_DB tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });

 });