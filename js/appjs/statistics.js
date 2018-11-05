$(document).ready(function() {
    $("#btnPrintStatistics").hide();
    $('.btnDisplayStatistics').click(function(e) {
        $("#btnPrintStatistics").hide();
        e.preventDefault();
        var reqUrl = '/tactic/statistics.php';
        $.ajax({
            url: reqUrl,
            type: "GET",
            data: {
                eventId: $('#eventName').val(),
                subEventId: $('#subEventName').val(),
                statisticsClassificationId: $('#statisticsClassificationId').val()
            },
            success: function(data) {
                retArray = JSON.parse(data)
                if (retArray.length <= 0) {
                    $("#btnPrintStatistics").hide();
                } else {
                    $("#btnPrintStatistics").show();
                }

                $("#divstatistics").show();
                $charts.renderPieChart(
                    "divstatistics",
                    retArray, "الإحصائيات حسب عدد المسجلين");


            }
        });

    });


    $('#btnPrintStatistics').click(function(e) {
        var objBrowse = window.navigator;
        if (objBrowse.appName == "Opera" || objBrowse.appName == "Netscape") {
            setTimeout("window.print()", 1000);
        } else {
            window.print();
        }
    });


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

});