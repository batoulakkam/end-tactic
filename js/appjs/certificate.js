 $(document).ready(function() {

     //delete event
     $(".adelete").click(function() {
         $("#hdCertificateId").val($(this).data("id"));
         $('#modalDelete').modal('show');
     });

     $('#btnConfirmDelete').click(function() {
         var certificateId = $('#hdCertificateId').val();
         $.ajax({
             type: "GET",
             dataType: 'JSON',
             url: "manageCertificate.php",
             data: {
                 certificateId: certificateId, //hdCertificateId
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
     $(".formDivAddCertificate").validate({
         // Specify validation rules
         rules: {
             eventName: {
                 required: true,
                 maxlength: 30
             },

             fileToUpload: {
                 required: true,

             },



         },

         messages: {
             eventName: {
                 required: "حقل مطلوب",
                 maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
             },

             fileToUpload: {
                 required: "حقل مطلوب",
             },

         }
     });
     // end of validate add Certificate
     $(".formDivEditCertificate").validate({
         // Specify validation rules
         rules: {
             eventName: {
                 required: true,
                 maxlength: 30
             },

             fileToUpload: {
                 required: true,

             },



         },

         messages: {
             eventName: {
                 required: "حقل مطلوب",
                 maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
             },

             fileToUpload: {
                 required: "حقل مطلوب",
             },

         }
     });
     // end of validate Edit Certificate

 });