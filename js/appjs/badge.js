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



    // send the info of image to write it on the image 
    $('#passImageIfon').click(function() {
        // get value of required variable and pass it to imagetext.php
        var visitorName = $("#lblVisitorName").offset();
        // var lblVistorName =document.getElementById("lblVistorName").getBoundingClientRect();
        var visitorCareer = $("#lblCareer").offset();
        var barcode = $("#dvBarcode").offset();

        var myImg = $("#myImg").offset();
        // var myImg =document.getElementById("myImg").getBoundingClientRect();
        var img = document.getElementById('myImg');
        //or however you get a handle to the IMG
        var width = Math.round(img.clientWidth);
        var height = Math.round(img.clientHeight);


        visitorName = ("X" + visitorName.left + "Y" + visitorName.top);
        visitorCareer = ("X" + visitorCareer.left + "Y" + visitorCareer.top);
        barcode = ("X" + barcode.left + "Y" + barcode.top);
        myImg = ("X" + myImg.left + "Y" + myImg.top);
        var color = $("#color").val();
        var barSize = $("#barSize").val();
        var fontSize = $("#fontSize").val();
        var txtlblvisittorName = $("#lblVisitorName").text();
        var txtlblvisittorCareer = $("#lblCareer").text();
        // get the name of image 
        var name = $("#fileToUpload")[0].files[0] == undefined ? "badge.jpg" : $("#fileToUpload")[0].files[0].name;

        //alert(visitorName + "uu" + visitorCareer + " &" + barcode + " &" + myImg);

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
                myImg: myImg,
                width: width,
                height: height,
                lblvisittorNameVal: txtlblvisittorName,
                lblvisittorCareerVal: txtlblvisittorCareer
            },
            //success enter data  
            success: function(data) {
                //to replace the source of image
                $('#myImg').html(data);
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