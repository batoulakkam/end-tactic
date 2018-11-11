$(document).ready(function() {

    
    $(".adelete").click(function() {
        $("#hdEventId").val($(this).data("id"));
        $('#modalDelete').modal('show');
    });

    $('#btnConfirmDelete').click(function() {
        var eventId = $('#hdEventId').val();
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "manageForm.php",
            data: {
                eventId: eventId, //hdEventId
                isDeleteAction: true
            },
            //success enter data
            success: function(data) {
                if (data == true) {
                    location.reload();
                } else {

                    var errorMeesage = "<div class='alert alert-danger alert-dismissible'>" +
                        "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
                        "فشل عملية الحذف يرجى التحقق</div>";
                    $(".panel-heading").before(errorMeesage);

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var errorMeesage = "<div class='alert alert-danger alert-dismissible'>" +
                    "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
                    "فشل عملية الحذف يرجى التحقق</div>";
                $(".panel-heading").before(errorMeesage);
            }
        });
    });
	
	
$("#formDiv").validate();

$("#nameAttende").rules("add", {
    required: true,
    maxnlength:30,
    messages: {
        required: "حقل مطلوب يرجى إدخال الاسم", maxnlength: "لا يمكن تجاوز الطول المسموح"}
});
    
$("#emailAttende").rules("add", {
    required: true, maxnlength:60,email:true, 
    messages: {
        required: "حقل مطلوب يرجى البريد الالكتروني", maxnlength: "لا يمكن تجاوز الطول المسموح",email:"يرجى التحقق من نمط البريد "}
});
$("#phoneAttende").rules("add", { required: true,minlength: 10,
phoneno:true,messages: { required: "حقل مطلوب يرجى الهاتف", minlength: "تحقق من الهاتف "                      }});	
$("#ageAttende").rules("add", { required: true, messages: { required: "حقل مطلوب يرجى العمر"}});
$("#eduAttende").rules("add", { required: true, maxnlength:10, messages: { required: "حقل مطلوب يرجى مستوى التعليم"}});
$("#jobAttende").rules("add", { required: true, maxnlength:30, messages: { required: "حقل مطلوب يرجى إدخال المهنة", maxnlength: "لا يمكن تجاوز الطول المسموح"}});
$("#natiAttende").rules("add", { required: true, messages: { required: "حقل مطلوب يرجى إختيار الجنسية"}});
$("#IDAttende").rules("add", { required: true, maxnlength:30, messages: { required: "حقل مطلوب يرجى إدخال الهوية", maxnlength: "لا يمكن تجاوز الطول المسموح"}});
$("#txtVIPAttendee").rules("add", { required: true, maxnlength:5, messages: { required: "حقل مطلوب يرجى إدخال كود الاشخاص المهمة", maxnlength: "لا يمكن تجاوز الطول المسموح"}});
  
    // end of validate 
});
 