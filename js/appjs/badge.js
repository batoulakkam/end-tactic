$(document).ready(function() {

    // select position on image to write on it 
    var position;
    $(function() {
        $("#myImg").click(function(e) {
    
          var offset = $(this).offset();
          var relativeX = Math.round((e.pageX - offset.left));
          var relativeY = Math.abs(Math.round((e.pageY - offset.top)));
           position= "X" +relativeX + "Y" +relativeY ;
          $("#valueposition").val( position );
          
    
        });
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
        var x_yposition = $("#valueposition").val(); 
        var color = $("#color").val();
        var barSize = $("#barSize").val();
        var fontSize = $("#fontSize").val();
        // get the name of image 
        var name = document.getElementById("fileToUpload").files[0].name;
        name="123"+name;
        alert(color+barSize+fontSize+x_yposition+name);
        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "imagetext.php",
        data: {
            text: text,
            x_yposition: x_yposition,
            color: color, 
            barSize: barSize,
            fontSize: fontSize , 
            sorce:name
        },
        //success enter data  
        success: function(data) {
                //to replace the source of image
                $('#myImg').html(data); 
        }
       
    });

    });

    
    // red the info of upload image 
    $(document).on('change', '#fileToUpload', function(){
        var name = document.getElementById("fileToUpload").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(ext != 'jpg' ) 
        {
         alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("fileToUpload").files[0]);
        var f = document.getElementById("fileToUpload").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 1000000)
        {
         alert("Image File Size is very big");
        }
        else
        {
         form_data.append("fileToUpload", document.getElementById('fileToUpload').files[0]);
         $.ajax({
             
          url:"upload.php",
          method:"POST",
          data: form_data,
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        $('#myImg').html(data);
       }
      });
     }
    });

    /*
    $(document).on('change', '#fileToUpload', function(){
        $.ajax({
            url:"upload.php",
            method:"POST",
            data: {
               " urlImage" : "<?php  print $location; ?>"
               },
            
               
            success:function(data)
            {
            $('#myImg').html(data);
            }
        });
    });  */

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
            color:{
                required: true
            },
            fontSize:{
                required: true
            },
            barSize:{
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