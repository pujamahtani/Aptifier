
$(function () {
	  $("#branch").hide();
		 $("#class").hide();
		  $("#div").hide();
		 $("#photo").hide();      
	$("#user_type").change(function () {
     var test = $("#user_type").val();
	 if(test==0 || test== "1" || test =="2" || test=="4"){
		  $("#branch").hide();
		 $("#class").hide();
		  $("#div").hide();
		 $("#photo").hide();
		 }else if(test ==  "3"){
		  $("#branch").show();
		 $("#class").show();
		$("#photo").hide();
		 }else{
		$("#branch").show();
	    $("#class").show();
	    $("#div").show();
		 }
	 
        });

    });
		