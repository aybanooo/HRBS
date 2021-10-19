const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const curr_timezone = moment.tz.guess();



const getCheckableRoomList = () => {
    $.ajax({
      type: "get",
      url: "/admin/customFiles/php/UI/getCheckableRooms.php",
      dataType: "html",
      success: function (response) {
        refreshCheckableRoomLists(response); 
      }
    });
}

const toggleButtonDisabled = (selector = null, disableBtnScopeSelector = "*", disabledText = "Loading...") => {
    if(selector==null || typeof selector == "int") return;
    disableBtnScopeSelector = disableBtnScopeSelector.trim();
    disableBtnScopeSelector = disableBtnScopeSelector == "" || disableBtnScopeSelector == null ? "*" : disableBtnScopeSelector;
    if(typeof $(disableBtnScopeSelector+" .btn").prop('disabled')==="undefined" || $(disableBtnScopeSelector+" .btn").prop('disabled') == false) {
      $(disableBtnScopeSelector +" .btn").prop('disabled', true);
      //$(selector + " > span").addClass('d-none');
      if(typeof selector == 'string') {
        $(selector + " > *").addClass('d-none');
        if(disabledText)
        $(selector).append('<span class="disabledText ml-2">'+disabledText+'</span>');
        $(selector).prepend(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);
      } else {

      }
    } else {
      $("#btn-changeSelection").attr('disabled', '');
      $(selector + " > .spinner-border").remove();
      $(selector + " > .disabledText").remove();
      $(selector + " > *").removeClass('d-none');
      //$(selector + " > span").removeClass('d-none');
      $(disableBtnScopeSelector+" .btn").prop('disabled', false);
    }
}

const refreshCheckableRoomLists = (checkEl) => $(".check-roomType").replaceWith(checkEl);
  
$(function () {

getCheckableRoomList();

//Event Listeners
    $("#btn-calendar").click(function () {
        toggleButtonDisabled("#btn-calendar .btn", "#addVoucherModal", "");
        $.ajax({
            type: "get",
            url: "/admin/customFiles/php/database/validations/getCurrentDate.php",
            dataType: "json",
            success: function (response) {
                toggleButtonDisabled("#btn-calendar .btn", "#addVoucherModal", "");
                var minDate = new Date(response+" UTC");
                //console.log(minDate);
                $('#reservationdatetime').datetimepicker('minDate', minDate)
                $('#reservationdatetime').data("datetimepicker").toggle();
            }
        });
    });

    $("#maxSpend").change(function () {
        $("#minSpend").valid();
    });        

    $("#minSpend").change(function () { 
        $("#maxSpend").valid();
    }); 

    $("#check-customCode, input[name='formatPlacement']").change(function () { 
        var enableCustomCode = $("#check-customCode").prop('checked') ;
        var quantityDisable = enableCustomCode && $("#formatPlacement-none").prop('checked');
        if (quantityDisable)
            $("#quantity").val(1);
        $("#quantity").prop('disabled', quantityDisable);
        $("#format, input[name='formatPlacement']").prop('disabled',  !enableCustomCode);
    });

    $("#format").on('keyup', function () { 
        var placement = $("input[name='formatPlacement']:checked").val();
        if(placement==1)
            $("#sampleCode").text( "mh2xa5-"+$("#format").val() );
        else if(placement==2)
            $("#sampleCode").text( $("#format").val()+"-mh2xa5" );
        else
            $("#sampleCode").text( $("#format").val() );
    });
    $("input[name='formatPlacement']").change(function() {
        var placement = $("input[name='formatPlacement']:checked").val();
        if(placement==1)
            $("#sampleCode").text( "mh2xa5-"+$("#format").val() );
        else if(placement==2)
            $("#sampleCode").text( $("#format").val()+"-mh2xa5" );
        else
            $("#sampleCode").text( $("#format").val() );
    });
//Event Listeners End

// Form Validation
    $.validator.addMethod("greaterThanOrEq",
    function (value, element, param) {
        var $otherElement = $(param);
        if ( value == 0 || $(param).val() == 0 ) {
            return true;
        }
        return parseInt(value, 10) >= parseInt($otherElement.val(), 10);
    });
    $.validator.addMethod("lessThanOrEq",
    function (value, element, param) {
        var $otherElement = $(param);
        if ( value == 0 || $(param).val() == 0 ) {
            return true;
        }
        return parseInt(value, 10) <= parseInt($otherElement.val(), 10);
    });
    $.validator.addMethod("notNegative",
        function (value, element, param) {
        if(param) {
            return value >= 0 ? true : false;
        }
        return true;
    });
    $.validator.addMethod("positiveOnly",
        function (value, element, param) {
        if(param) {
            return value > 0 ? true : false;
        }
        return true;
    }, "Value must be a greater than 0");
    $.validator.addMethod("regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "The only allowed characters are A-Z a-z 0-9 _ and -"
    );
    $('#newVoucher').validate({
        rules: {
            format: {
                required: () => $("#check-customCode").prop('checked'),
                regex: "^[a-zA-Z0-9_\-]*$",
                maxlength: 8
            },
            value: {
                required: true,
                positiveOnly: true
            },
            minSpend: {
                notNegative: true,
                lessThanOrEq: "#maxSpend"
            },
            maxSpend: {
                notNegative: true,
                greaterThanOrEq: "#minSpend"
            },
            quantity: {
                required: true
            },
            validUntilDate: {
                required: true
            },
            "forList[]": {
                required: true,
            }   
        },
        messages: {
            "forList[]": "Please select at least 1 room type",
            value: {
                required: "Please provide a value",
            },
            minSpend: {
                lessThanOrEq: "Must be less than maximum spend",
                notNegative: "Value cannot be a negative number",
            },
            maxSpend: {
                greaterThanOrEq: "Must be greater than minimum spend",
                notNegative: "Value cannot be a negative number",
            },
            quantity: {
                required: "Please provide a quantity",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group, .form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form, e) {
            //console.log($(form).serializeArray());
            toggleButtonDisabled("#newVoucher button[type='submit']", "#newVoucher", "");
            $.ajax({
                type: "post",
                url: "/admin/customFiles/php/database/voucherControls/createVoucher.php",
                data: $(form).serializeArray(),
                dataType: "json",
                success: function (response) {
                    //console.log(response);
                    toggleButtonDisabled("#newVoucher button[type='submit']", "#newVoucher");
                    Toast.fire({
                        icon: response.status,
                        title: response.message
                     });
                     if(response.isSuccessful) {
                        $('#newVoucher').trigger("reset");
                        $("#addVoucherModal").modal('toggle')
                        tableVouchers.ajax.reload();
                     } else {
                        
                     }
                }
            });
            //$('#newVoucher').trigger("reset");
        }
    });
//Form Validation End

//Voucher datatable
$.map()
tableVouchers = $('#table-vouchers').DataTable({
    responsive: true,
    dom: "l<'row'<'col'B><'col'f>><'#colvis.row'>rt<'row'<'col'i><'col'<'float-right'p>>>",
    select: {
        style: 'multi',
        selector: '.select-checkbox',
        items: 'row',
    },
    buttons: [
        {
            text: "Add Voucher",
            attr: {
                class: "btn btn-primary",
                id: "addVoucherModalBtn",
                'data-toggle': "modal",
                'data-target': "#addVoucherModal",
                class: "btn btn-primary btn-voucher"
            }
        }, {
            text: "Delete",
            attr: {
                class: "btn btn-danger",
                id: "btn-deleteVoucher"
            },
            action: (e, dt) => {
                
                code = tableVouchers.rows('.selected').data().pluck("code").toArray();
                if (code.length <= 0) {
                    Toast.fire({
                        icon: 'error',
                        title: "There are no item/s selected."
                    });
                    return;
                }
                toggleButtonDisabled("#btn-deleteVoucher", ".dt-buttons", "")
                $.ajax({
                    type: "post",
                    url: "/admin/customFiles/php/database/voucherControls/deleteVoucher.php",
                    data: {
                        code: code
                    },
                    dataType: "json",
                    success: function (response) {
                        //console.log(response);
                        Toast.fire({
                            icon: response.status,
                            title: response.message
                        });
                        toggleButtonDisabled("#btn-deleteVoucher", ".dt-buttons", "")
                        tableVouchers.ajax.reload();
                    }
                });
            }
        }, {
            
            text: "Refresh",
            attr: {
                id: 'btn-refresh'
            },
            action: (e, dt, el) => {
                tableVouchers.clear().draw()
                toggleButtonDisabled('#btn-refresh', '#voucherCard', "");
                dt.ajax.reload(() => toggleButtonDisabled('#btn-refresh', '#voucherCard'));
            }
        }, {
            extend: 'collection',
            text: 'Export',
            attr: {
                class: "btn btn-default dropdown-toggle"
            },
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "Copy",
                    exportOptions: {
                        columns: [":not(:last-child)"]  
                    }
                }, {
                    extend: "print",
                    text: "Print",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    }
                }, {
                    extend: "excelHtml5",
                    text: "Excel",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    }
                }, {
                    extend: "csvHtml5",
                    text: "CSV",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    }
                }, {
                    extend: "pdfHtml5",
                    text: "PDF",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    }
                }
            ]
        }
    ],
    ajax: {
        url: '/admin/customFiles/php/database/voucherControls/getVouchers.php',
        dataSrc: ''
    },
    columns: [
        {data: 'code'},
        {data: 'value'},
        {data: 'minSpend'},
        {data: 'maxSpend'},
        {
            data: 'validUntil',
            render: (data) => moment.utc(data).local().format('YYYY-MM-DD HH:mm:ss ') + curr_timezone
            
        },
        {data: 'name'},
        {data: 'description'},
        {
            data: 'forRoomTypes',
            render: (data) => {
                console.log(data);
                //return "debugging...";
                return $.map(data, (i) => { return `<span class="py-1 px-2 m-1 bg-secondary rounded d-inline-block">${i.split(" ").join("&nbsp;")}</span>`}).join("<span class='position-absolute text-transparent'>,</span>");
            }
        },
        {
            defaultContent: ''
        }
    ],
    columnDefs: [
        {
            targets: 8,
            responsivePriority: 1, 
            className: 'select-checkbox px-4 align-middle position-relative',
            orderable: false
        }
    ],
    order: [0, 'asc']
  });

  $("#colvis").append(`
    <span class="d-flex align-items-center mx-2">Column Visibility:
        <button class="btn btn-link d-inline p-1 customColvis">Code</button>-
        <button class="btn btn-link d-inline p-1 customColvis">Value</button>-
        <button class="btn btn-link d-inline p-1 customColvis">Minimum</button>-
        <button class="btn btn-link d-inline p-1 customColvis">Maximum</button>-
        <button class="btn btn-link d-inline p-1 customColvis">Valid Until</button>-
        <button class="btn btn-link d-inline p-1 customColvis">Label</button>-
        <button class="btn btn-link d-inline p-1 customColvis">Description</button>
        <button class="btn btn-link d-inline p-1 customColvis">Assigned Rooms</button>
    </span>`);

    $(".customColvis").click((e) => {
        var index = $(e.currentTarget).index();
        var colTarget = tableVouchers.column( index );
        colTarget.visible( !colTarget.visible() );
    });
//Voucher datatable end


//Enable/Disable Voucher

$('#toggleVoucher').change((e) => {
    if(typeof toggleIsDone === "undefined") {
        toggleIsDone = true;
    }
    if(!toggleIsDone) {
        Toast.fire({
            icon: "info",
            title: "Please wait..."
        });
        $('#toggleVoucher').prop("checked", !$('#toggleVoucher').prop("checked"));
        return;
    }
    toggleIsDone = false;
    $.ajax({
        type: "post",
        url: "customFiles/php/settingsControls/toggleVoucher.php",
        data: {
            value: $('#toggleVoucher').prop('checked')
        },
        dataType: "json",
        success: function (response) {
            toggleIsDone = true;
            Toast.fire({
                icon: response.status,
                title: response.message
            });
        }
    });
});

//Enable/Disable Voucher END

});
