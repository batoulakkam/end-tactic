$(document).ready(function() {

    $("#lblVisitorName").draggable({
        refreshPositions: true
    });
    $("#lblCareer").draggable({
        refreshPositions: true
    });
    $("#dvBarcode").draggable({
        refreshPositions: true
    });


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
    //  



    // send the info of image to write it on the image for testing
    $('#passImageIfon').click(function() {
        // get value of required variable and pass it to imagetext.php
        var eventId=$("#eventId").val();
        var color = $("#color").val();
        var barSize = $("#barSize").val();
        var fontSize = $("#fontSize").val();
        var visitorName = $("#lblVisitorName").offset();
        var visitorCareer = $("#lblCareer").offset();
        var barcode = $("#dvBarcode").offset();
        var myImg = $("#myImg").offset();
        visitorName = ("X" + ((visitorName.left)-(myImg.left))  + "Y" + ((visitorName.top)-(myImg.top)));
        visitorCareer = ("X" + ((visitorCareer.left)-(myImg.left) ) + "Y" + ((visitorCareer.top)-(myImg.top)));
        barcode = ("X" + ((barcode.left)-(myImg.left))  + "Y" + ((barcode.top)-(myImg.top)));
        // get the name of image 
        var name = $("#fileToUpload")[0].files[0] == undefined ? "badge.jpg" : $("#fileToUpload")[0].files[0].name;
        var attendeeID=0;
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "imagetext.php",
            data: {
                color: color,
                barSize: barSize,
                fontSize: fontSize,
                sorce: name,
                visitorName: visitorName,
                visitorCareer: visitorCareer,
                visitorBarcode: barcode,
                eventId:eventId,
                attendeeID:attendeeID
            },
            success: function(data) {
                //var url=data;
               // $('#viewBadge').attr('src','UploadFile/49/badge/badge.jpg');
                $('#viewBadge').attr('src',data);
                 $('#viewAttendeeBadge').modal('show');
            },
           
        });

        /*
        
        */
        
    });

    $('#add').click(function() {
        // get value of required variable and pass it to imagetext.php
        var visitorName = $("#lblVisitorName").offset();
        var visitorCareer = $("#lblCareer").offset();
        var barcode = $("#dvBarcode").offset();
        var myImg = $("#myImg").offset();
        visitorName = ("X" + ((visitorName.left)-(myImg.left))  + "Y" + ((visitorName.top)-(myImg.top)));
        visitorCareer = ("X" + ((visitorCareer.left)-(myImg.left) ) + "Y" + ((visitorCareer.top)-(myImg.top)));
        barcode = ("X" + ((barcode.left)-(myImg.left))  + "Y" + ((barcode.top)-(myImg.top)));  
        document.getElementById('name').value =visitorName;
        document.getElementById('career').value =visitorCareer;
        document.getElementById('barcode').value =barcode;
    });
// to show pop message include updated badge
   

    $('#btnPrintBadge').click(function(e) {
        var objBrowse = window.navigator;
        if (objBrowse.appName == "Opera" || objBrowse.appName == "Netscape") {
            setTimeout("window.print()", 1000);
        } else {
            window.print();
        }
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
            valueposition: {
                required: true
            },
            color: {
                required: true
            },
            fontSize: {
                required: true
            },
            barSize: {
                required: true
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

            valueposition: {
                required: "حقل مطلوب"
            },

            color: {
                required: "حقل مطلوب"
            },

            fontSize: {
                required: "حقل مطلوب"
            },

            barSize: {
                required: "حقل مطلوب"
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