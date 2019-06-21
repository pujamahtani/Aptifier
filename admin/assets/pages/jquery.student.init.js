/*$(document).ready(function() {
	$('form').parsley();
	$("#datepicker-autoclose").datepicker({
		autoclose: !0,
		todayHighlight: !0
	});
});
*/
/*
The below function is used to create a modal when we press the delete button to delete a student entry.
This is using SweetAlert plugin to create a user friendly modal!
 */
! function (t) {
	"use strict";
	var n = function () {};
	n.prototype.init = function () {
		 t(".delete-student").click(function () {
			 var sid = $(this).attr('data-student-id');
			 swal({
				 title: "Are you sure, you wanna delete this student entry?",
				 text: "You won't be able to revert this!",
				 type: "warning",
				 showCancelButton: !0,
				 confirmButtonClass: "btn btn-confirm mt-2",
				 cancelButtonClass: "btn btn-cancel ml-2 mt-2",
				 confirmButtonText: "Yes, delete it!"
			 }).then(function () {
				 $.ajax({
					 type: 'POST',
					 url: 'includes/delete-student.php',
					 data: 'sid=' + sid
				 }).done(function (response) {
					 
					 swal({
						 title: "Deleted !",
						 text: "Student has been deleted!",
						 type: "success",
						 confirmButtonClass: "btn btn-confirm mt-2"
					 }).then(function(){
						 self.location = "student.php";
					 })
				 }).fail(function () {
						 swal({
							 title: "Issue !",
							 text: "There was issue deleteing student, please try again later!",
							 type: "error",
							 confirmButtonClass: "btn btn-confirm mt-2"
						 })
					 })
			 })
		 })
	}, t.SweetAlert = new n, t.SweetAlert.Constructor = n
}(window.jQuery),
	function (t) {
		"use strict";
		t.SweetAlert.init()
	}(window.jQuery);