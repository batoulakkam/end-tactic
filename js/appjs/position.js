$(document).ready(function() {
    var position;
    $(function() {
        $("#myImg").click(function(e) {

            var offset = $(this).offset();
            var relativeX = Math.round((e.pageX - offset.left));
            var relativeY = (e.pageY - offset.top);
            position = "X" + relativeX + "Y" + relativeY;
            $("#valueposition").val(position);


        });
    });


    //$('input').on('click',function() {
    $('#passImageIfon').click(function() {
        var text = $("#text").val();
        var x_yposition = position;
        var color = $("#color").val();
        var barSize = $("#barSize").val();
        var fontSize = $("#fontSize").val();

        $.ajax({
            type: "GET",
            dataType: 'JSON',
            url: "imagetext.php",

            data: {
                text: text,
                x_yposition: x_yposition,
                color: color,
                barSize: barSize,
                fontSize: fontSize
            },
            //success enter data  
            success: function(data) {
                if (data == true) {
                    //to replace the source of image
                    $('img').attr("src", "");
                    $('img').attr("src", data);
                }

            },

        });

    });



    $(".formEditImage").validate({
        // Specify validation rules
        rules: {
            text: {
                required: true
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
            text: {
                required: "حقل مطلوب"
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
    // end of validate 

});