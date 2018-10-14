$(document).ready(function() {

    $(".formDivRegister").validate({
        // Specify validation rules
        rules: {
            Name: {
                required: true,
                maxlength: 30
            },

            Email: {
                required: true,
                maxlength: 50
            },

            Password: {
                required: true,
                maxlength: 255
            },

            Password2: {
                required: true,
                maxlength: 255

            },

            gender: {
                required: true,
                maxlength: 6
            },

            Birthday: {
                required: true,

            },



        },

        messages: {
            eventName: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },

            Name: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 30 محرف"
            },

            Email: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 50 محرف"
            },

            Password: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 255 محرف"
            },

            Password2: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 255 محرف"

            },

            gender: {
                required: "حقل مطلوب",
                maxlength: "لايمكنك إدخال نص يزيد عن 6 محرف"
            },

            Birthday: {
                required: "حقل مطلوب",

            },




        },
    });
    // end of validate register
});