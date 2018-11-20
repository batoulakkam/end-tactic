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

//***************************************************************************************** */
$(document).ready(function(){
    $('#fileToUpload').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            $('#thumb-output').html(''); //clear html of output element
            var data = $(this)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(jpe?g)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                        $('#thumb-output').append(img); //append image to output element
                    };
                      })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
});
