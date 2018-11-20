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

    
    $("#lblVisitorName").draggable({
        refreshPositions: true
    });
    $("#lblCareer").draggable({
        refreshPositions: true
    });
    $("#dvBarcode").draggable({
        refreshPositions: true
    });

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
        var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
        fd.append('file', files);
        fd.append('color', color);
        fd.append('barSize', barSize);
        fd.append('fontSize', fontSize);
        fd.append('sorce', name);
        fd.append('visitorName', visitorName);
        fd.append('visitorCareer', visitorCareer);
        fd.append('barcode', barcode); 
        fd.append('eventId', eventId);
        fd.append('attendeeID', attendeeID);

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: "imagetext.php",
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                data=data+"?"+new Date().getTime();
                $('#viewBadge').attr('src',data);
                $('#viewAttendeeBadge').modal('show');
            },
           
        });
    });
  // this part for print image 
document.getElementById("btnPrintBadge").onclick = function () {
    printElement(document.getElementById("printmy"));
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
        // get value of required variable and pass it to imagetext.php
        var visitorName = $("#lblVisitorName").offset();
        var visitorCareer = $("#lblCareer").offset();
        var barcode = $("#dvBarcode").offset();
        var myImg = $("#myImg").offset();
        visitorName = ("X" + ((visitorName.left)-(myImg.left))  + "Y" + ((visitorName.top)-(myImg.top)));
        visitorCareer = ("X" + ((visitorCareer.left)-(myImg.left) ) + "Y" + ((visitorCareer.top)-(myImg.top)));
        barcode = ("X" + ((barcode.left)-(myImg.left))  + "Y" + ((barcode.top)-(myImg.top)));  
        myImg=("X" + (myImg.left)  + "Y" +(myImg.top));
        document.getElementById('name').value =visitorName;
        document.getElementById('career').value =visitorCareer;
        document.getElementById('barcode').value =barcode;
        document.getElementById('imgPosition').value =myImg;
    });

    $(".formDivAddBadge").validate({
        // Specify validation rules
        rules: {
            eventName: {
                required: true,
                maxlength: 30
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

            badgeType: {
                required: true,


            },
        },

        messages: {
            eventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },

            badgeType: {
                required: "حقل مطلوب",
            },
        }
    });
    // end of validate Edit badge
});