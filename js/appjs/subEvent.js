$(document).ready(function() {

    //delete event
    $(".adelete").click(function() {
        $("#hdSubEventId").val($(this).data("id"));
        $('#modalDelete').modal('show');
    });

    $('#btnConfirmDelete').click(function() {
        var subEventId = $('#hdSubEventId').val();
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "manageSubEvent.php",

            data: {
                subEventId: subEventId, //hdSubEventId
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

    $(".formDivAddSubEvent").validate({
        // Specify validation rules
        rules: {
            subEventName: {
                required: true,
                maxlength: 30
            },

            subDescription: {
                required: true,
                maxlength: 200
            },



        },

        messages: {
            subEventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },

            subDescription: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 200 محرف"
            },



        }
    });

    // end of validate add Subevent

    $(".formDivEditSubEvent").validate({
        // Specify validation rules
        rules: {
            subEventName: {
                required: true,
                maxlength: 30
            },

            description: {
                required: true,
                maxlength: 200
            },



        },

        messages: {
            subEventName33: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },

            description: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 200 محرف"
            },



        }
    });
    // end of validate Edit subevent

});