$('#addRoomDiv').on('click', 'a', function() {
    room = $(this).find('h5').text();
    appendRoomToReservation(room);
    console.log(room);
});

function appendRoomToReservation(roomType) {
    str = `
    <tr><td></td><td><hr></td></tr>
    <tr align="right"  class="roomEntry">
        <th>Room:</th>
        <td>${roomType}</td>
    </tr>
    <tr align="right" class="roomEntryRate">
        <th><label for="rate">Rate:</label></th>
        <td>
            <select name="rate" id="rate">
                <option value="rate1">Rate #1</option>
                <option value="rate2">Rate #2</option>
                <option value="rate3">Rate #3</option>
            </select>
        </td>
    </tr>`;
    target = $('.roomEntryRate:last');
    console.log();
    $(str).insertAfter( target );
    //target.append(doc.getRootNode().body);
    //target.append(doc2);
}