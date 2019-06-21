function enableComponents(){
	console.log("hi");
	inputs = document.getElementsByTagName('input');
	document.getElementById("edit_profile").style.display="none";
	for (index = 3; index < inputs.length; ++index) 
		inputs[index].disabled=false;
	document.getElementById("edit_profile_submit").style.display="block";
	
}