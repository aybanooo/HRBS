roomNums = {
    0 : {
        level: 1,
        start: 1,
        end: 1
    }
}

function generateKey() {
    key = 0;
    while((key) in roomNums){
        key++;
    }
    return key
}

function displayRoomNums() {
    inList = [];
    $(`#roomGenerationTable tbody input[type="hidden"]`).each( function() {
        inList.push($(this).val());
    });
    //console.log(inList);
    for(var key in roomNums) {
        if(inList.indexOf(key)!=-1){
            continue;
        };
        str = `
        <tr>
            <input type="hidden" value="${key}">
            <td><input type="number" min="0" value="${roomNums[key].level}" required></td>
            <td><input type="number" min="1" value="${roomNums[key].start}" required></td>
            <td><input type="number" min="1" value="${roomNums[key].end}" required></td>
            <td><a class="hoverable-danger" onclick="removeRow(${key}, this)">Remove</a></td>
        </tr>
        `;
        $('#roomGenerationTable tbody').append( str );
    }
}

function addARow() {
    roomNums[generateKey()] = {
        level: 1,
        start: 1,
        end: 1
    }
    displayRoomNums();
}

function removeRow(key, el) {
    delete roomNums[key];
    el.parentElement.parentElement.remove();
    displayRoomNums();
}

$(document).ready(function () {
    displayRoomNums();
});