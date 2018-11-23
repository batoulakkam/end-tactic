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

    $("#lblEventName").draggable({
        refreshPositions: true
    });

    $("#lblVisitorName").draggable({
        refreshPositions: true
    });

    $("#lblEventDate").draggable({
        refreshPositions: true
    });

    // send the info of image to write it on the image 
    $('#passImageInfo').click(function() {
        // get value of required variable and pass it to imagetext.php
        debugger;
        var eventId = $("#eventId").val();
        var color = $("#color").val();
        var fontSize = $("#fontSize").val();
        var eventName = $("#lblEventName").offset();
        var visitorName = $("#lblVisitorName").offset();
        var eventDate = $("#lblEventDate").offset();
        var myImg = $("#myImg").offset();
        var lblEventNameVal = $("#lblEventName").text();
        var lblVisitorNameVal = $("#lblVisitorName").text();
        var lblEventDateVal = $("#lblEventDate").text();
        eventName = "X" + ((eventName.left )- (myImg.left)) + "Y" + ((eventName.top) - (myImg.top));
        visitorName = "X" + ((visitorName.left) - (myImg.left)) + "Y" + ((visitorName.top) - (myImg.top));
        eventDate = "X" + ((eventDate.left) - (myImg.left)) + "Y" + ((eventDate.top) - (myImg.top));
        //myImg="x"+myImg.left+"y"+myImg.top;
        var name = $("#fileToUpload")[0].files[0] == undefined ? "certificate.jpg" : $("#fileToUpload")[0].files[0].name;
        var attendeeID = 0;

        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
        fd.append('file', files);
        fd.append('lblEventNameVal', lblEventNameVal);
        fd.append('lblVisitorNameVal', lblVisitorNameVal);
        fd.append('lblEventDateVal', lblEventDateVal);
        fd.append('color', color);
        fd.append('fontSize', fontSize);
        fd.append('source', name);
        fd.append('eventName', eventName);
        fd.append('visitorName', visitorName);
        fd.append('eventDate', eventDate);
        fd.append('eventId', eventId);
        fd.append('attendeeID', attendeeID);

        $.ajax({
            type: "POST",
            url: "imageWritingCertificate.php",
            data: fd,
            contentType: false,
            processData: false,
            //success enter data  
            success: function(data) {
                 data = data + "?" + new Date().getTime();
                $('#viewCertificate').attr('src', data);
                $('#viewAttendeeCertificate').modal('show');
            },

        });

    });

    // this part for print image 
    document.getElementById("btnPrintCertificate").onclick = function() {
        printElement(document.getElementById("printCertificate"));
    }

    function printElement(elem) {
        var domClone = elem.cloneNode(true);

        var $printSection = document.getElementById("printSection");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }

        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }

    $('#add').click(function() {
        // get value of required variable and pass it to imageWritingCertificate.php
        var eventName = $("#lblEventName").offset();
        var visitorName = $("#lblVisitorName").offset();
        var eventDate = $("#lblEventDate").offset();
        var myImg = $("#myImg").offset();
        eventName = "X" + ((eventName.left) - (myImg.left)) + "Y" + ((eventName.top) - (myImg.top));
        visitorName = "X" + ((visitorName.left) - (myImg.left)) + "Y" + ((visitorName.top) - (myImg.top));
        eventDate = "X" + ((eventDate.left) - (myImg.left)) + "Y" + ((eventDate.top) - (myImg.top));
        myImg = ("X" + (myImg.left) + "Y" + (myImg.top));
        document.getElementById('eventNamePosition').value = eventName;
        document.getElementById('visitorNamePosition').value = visitorName;
        document.getElementById('eventDatePosition').value = eventDate;
        document.getElementById('imagePosition').value = myImg;
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
            valueposition: {
                required: true
            },
            color: {
                required: true
            },
            fontSize: {
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
            valueposition: {
                required: "حقل مطلوب"
            },

            color: {
                required: "حقل مطلوب"
            },

            fontSize: {
                required: "حقل مطلوب"
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
 
        },

        messages: {
            eventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },
       }
    });
    // end of validate Edit Certificate

});