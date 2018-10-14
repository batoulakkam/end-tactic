$(document).ready(function() {
    $(".formDivLogIn").validate({
        // Specify validation rules
        rules: {

            Email: {
                required: true,
                maxlength: 50
            },

            Password: {
                required: true,
                maxlength: 255
            },
        },
        messages: {
            Email: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 50 محرف"
            },

            Password: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 255 محرف"
            },
        }
    });
});