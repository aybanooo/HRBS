function addAmenityEntry() {
    Swal.fire({
        title: 'Add an Amenity',
        html: `<form id="form-addAmenity">
        <div class="form-group">
            <input type="text" id="inp-amenityName" name="inp-amenityName" class="form-control form-control-border" placeholder="Amenity Name">
        </div>
        <div class="form-group">
            <label class="font-weight-normal" for="inp-textArea-description">Description</label>
            <textarea class="form-control" id="inp-textArea-description" rows="3"></textarea>
        </div>
        <input type="file" id="inp-imageFile" hidden>
        <label for="inp-imageFile" class="btn btn-link" >Select an image</label>
        <div class="demo d-none"></div>
        </form>`,
        confirmButtonText: 'Add',
        focusConfirm: false,
        preConfirm: async () => {
            if(!$("#inp-amenityName").valid()) {
                return false;
            }
            let fd = new FormData();
            if(!$(".demo").hasClass('d-none')) {
                let img = await $uploadCrop.croppie('result', {
                    type: 'blob',
                    size: 'original',
                    format: 'jpeg'
                }).then(function (resp) {
                    return resp;
                });
                //console.log(img);
                fd.append("file-image-amenityImage", img);
            }
            fd.append("inp-amenityName", $("#inp-amenityName").val());
            fd.append("inp-textArea-description", $("#inp-textArea-description").val());
            /*console.group("Form Data");
            for (var pair of fd.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            console.groupEnd("Form Data");*/
            var ajax = await $.ajax({
                type: "post",
                data: fd,
                processData: false,
                contentType: false,
                cache: false,   
                url: "/admin/customFiles/php/database/amenitiesControls/addAmenity.php",
                dataType: 'json',
                success: function (response) {
                    //console.log(response);                    
                    return(response);
                }
            });
            return ajax;
            //return {data: ajax};              
            /*if (true) {
            Swal.showValidationMessage(`Please enter login and password`)
            }*/
        }
    }).then((result) => {
        //console.log(result);
        if(typeof result.value !== 'undefined')
            setTimeout(()=> {
                Toast.fire({
                    icon: result.value.status,
                    title: result.value.message
                })
            },600);
    });
    $uploadCrop = $('.demo').croppie({
        enableExif: true,
        viewport: {
            width: 400,
            height: 300,
            type: 'square'
        },
        boundary: {
            width: 440,
            height: 330
        }
    });
    $("#form-addAmenity").validate({
        rules: {
            "inp-amenityName": {
                required: true
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            
        }
    });
}

function readFile(input) {
    if (input.files && input.files[0]) {
       var reader = new FileReader();
       
       reader.onload = function (e) {
           $('.demo').removeClass('d-none');
           $uploadCrop.croppie('bind', {
               url: e.target.result
           }).then(function(){
               console.log('jQuery bind complete');
           });
           
       }
       
       reader.readAsDataURL(input.files[0]);
   }
   else {
       swal("Sorry - you're browser doesn't support the FileReader API");
   }
}

$("body").on("change", "#inp-imageFile", function() {
    readFile(this);
})

function loadAmenityCards() {
    $.ajax({
        type: "get",
        url: "customFiles/php/database/amenitiesControls/generateAmenityCardList.php",
        dataType: "html",
        success: function (response) {
            $("#amenityList").html(response);
        }
    });
}