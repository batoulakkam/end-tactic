$(document).ready(function() {

    //delete event
    $(".adelete").click(function() {
        $("#hdBadgeId").val($(this).data("id"));
        $('#modalDelete').modal('show');
    });

    $('#btnConfirmDelete').click(function() {
        var badgeId = $('#hdBadgeId').val();
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "manageBadge.php",
            data: {
                badgeId: badgeId, //hdBadgeId
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
    $(".formDivAddBadge").validate({
        // Specify validation rules
        rules: {
            eventName: {
                required: true,
                maxlength: 30
            },

            fileToUpload: {
                required: true,

            },
            badgeType: {
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

            badgeType: {
                required: "حقل مطلوب",
            },

        }
    });
    // end of validate add Badge

    $(".formDivEditBadge").validate({
        // Specify validation rules
        rules: {
            eventName: {
                required: true,
                maxlength: 30
            },

            fileToUpload: {
                required: true,

            },
            badgeType: {
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

            badgeType: {
                required: "حقل مطلوب",
            },

        }
    });
    // end of validate Edit badge
});