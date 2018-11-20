$(document).ready(function() {

    if ($('.table tr').length > 1) {
        $('#modalWarninngalreadyHasWinner').modal('show');
    }

    // $("#btnPrintWinners").hide();
    // update this name to be subEvent ,clean code
    $("#subEventName").prop("disabled", true);

    $("#eventName").click(function() {
        var eventId = $(this).val();
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "addajaxsub.php",

            data: {
                eventId: eventId
            },
            //success enter data
            success: function(data) {

                var len = data.length;
                // to clear old data befor statr fill new data
                $("#subEventName").empty();
                $("#subEventName").append("<option value=''>اختيار</option>");
                for (var i = 0; i < len; i++) {
                    var subeventId = data[i]['subeventId'];
                    var subEventName = data[i]['subEventName'];

                    $("#subEventName").append("<option value='" + subeventId + "'>" + subEventName + "</option>");

                }
                $("#subEventName").prop("disabled", false);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#subEventName").empty();
                $("#subEventName").append("<option value=''>اختيار</option>");
                $("#subEventName").prop("disabled", true);
            }
        });
    });


    //delete event
    $(".bodyform").on("click", function(event) {
        event.preventDefault();
        // in case the user click the choose winner button
        if ($("#isSelectedchooseWinner").val() == "true") {
            $("#hdId").val($(this).data("id"));

        } else {
            // in case the user not click the choose winner button
            window.location.href = "/tactic/managePrize.php"
        }
    });


    //delete event
    $(".adelete").click(function() {

        $("#hdPrizeId").val($(this).data("id"));
        $('#modalDelete').modal('show');
    });


    $('#btnConfirmDelete').click(function() {
        var prizeId = $('#hdPrizeId').val();
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "managePrize.php",

            data: {
                prizeId: prizeId, //hdPrizeId
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
    $(".formDivAddPrize").validate({
        // Specify validation rules
        rules: {
            eventName: {
                required: true,
                maxlength: 30
            },

            prizeName: {
                required: true,
                maxlength: 30
            },

            prizeNum: {
                required: true
            },


        },

        messages: {
            eventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },


            prizeName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"


            },

            prizeNum: {
                required: "حقل مطلوب",

            },

        }
    });
    // end of validate add Prize

    $(".formDivEditPrize").validate({
        // Specify validation rules
        rules: {
            eventName: {
                required: true,
                maxlength: 30
            },

            subEventName: {
                required: true,
                maxlength: 30

            },
            prizeName: {
                required: true,
                maxlength: 30
            },

            prizeNum: {
                required: true,
                maxlength: 11
            },


        },

        messages: {
            eventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },

            subEventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"

            },

            prizeName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"


            },

            prizeNum: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 11 محرف"
            },

        }
    });
    // end of validate Edit prize
    $('#btnPrintWinners').click(function(e) {
        var objBrowse = window.navigator;
        if (objBrowse.appName == "Opera" || objBrowse.appName == "Netscape") {
            setTimeout("window.print()", 1000);
        } else {
            window.print();
        }
    });


});