var vouchers = {
    vl2k3ps : {
        value: 500,
        minSpend: 0,
        maxSpend: 0,
        maxUsage: 0,
        validUntil: new Date(),
        room: 1,
        dateCreated: new Date(),
        used: 0
    }
}

const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];



function makeid() {
    length = 7;
    var result = [];
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result.push(characters.charAt(Math.floor(Math.random() * 
    charactersLength)));
   }
   return result.join('');
}

function getUniqueID() {
    vouchKeys = Object.keys(vouchers);
    do{
        id = makeid();
    }while(vouchKeys.indexOf(id)!=-1)
    return id
}

function getCurrDate() {
    d = new Date();
    date = `${d.toGMTString()}`; 
    return date;
}

function deleteVoucher(code) {
    delete vouchers[code];
    
}

function createVoucher(form){
    n = form[3].value;
    for(var i=0; i<n; i++){
        id = getUniqueID();
        vouchers[id] = {
            value: Number(form[0].value),
            minSpend: Number(form[1].value),
            maxSpend: Number(form[2].value),
            maxUsage: Number(form[4].value),
            validUntil: new Date(form[5].value),
            room: form[6].value,
            dateCreated: new Date(),
            used: 0};
    }   
    displayVouchers();
}

function emptyStringToZero() {  

}

function displayVouchers() {
    voucherSet = ``;
    displayedVoucherList = [];
    $('#append-new-voucher').find('.voucherCode').each( function() {
        displayedVoucherList.push($(this).text());
      });
    parser = new DOMParser();

    for(var key in vouchers) {
        if(displayedVoucherList.indexOf(key)!=-1){
            continue;
        };
        str = `
        <tr>
            <td class="voucherCode">${key}</td>
            <td>${vouchers[key].value}</td>
            <td>${vouchers[key].minSpend}</td>
            <td>${vouchers[key].maxSpend}</td>
            <td>${vouchers[key].maxUsage}</td>
            <td>${vouchers[key].room}</td>
            <td>${vouchers[key].validUntil}</td>
            <td>${vouchers[key].dateCreated}</td>
            <td></td>
            <td><a class="hoverable-danger">Remove</a></td>
            </tr>
        `;
        $('#append-new-voucher').append(str);
    }
}

function deleteUnusedVoucher() {
    vouchers = {};
    $('#append-new-voucher').html('');
}

displayVouchers();

$('#btnUsedVoucherDelete').on('click', function() {
    deleteUnusedVoucher();
});