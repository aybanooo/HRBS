roomInfos = {
    "Peninsula Suite" : {
        rooms: {
            "Living Room": {
                0: "Wifi",
                1: "Premium Movies",
                2: "24' Tv"
            },
            "Bedroom": {
                0: "Great View",
                1: "24' Tv"
            },
            "Bathroom": {
                0: "Great View",
                1: "24' Tv"
            }
        } 
    },
    "Imperial Suite" : {
        rooms: {
            "Living Room": {
                0: "Wifi",
                1: "Premium Movies",
                2: "24' Tv"
            },
            "Bedroom": {
                0: "Great View",
                1: "24' Tv"
            }
        } 
    }
}

function updateSelectedColumns(inp1, inp2, inp3) {
    $('#appendRoomInfoHere').empty();
    if(inp1=="" && inp2=="" && inp3=="") {
        $('#appendRoomInfoHere').append(`<h3 class="d-block text-center">Please select a room</h3>`);
        return;
    }
    inputs = [inp1,inp2,inp3];
    cols = {};
    rows = [];
    for(i=0; i<inputs.length;i++) {
        if(inputs[i]==""){
            cols["no-_-item"] = {rooms:{}};
            continue;
        }
        cols[inputs[i]] = JSON.parse(JSON.stringify(roomInfos[inputs[i]]));
    }
    for (var key in cols) {
        if(cols=="no-_-item")
            continue;
        for (var subkey in cols[key]['rooms']) {
            if( !(rows.includes( subkey )) ) {
                rows.push(subkey);
            }
        }
    }
    var tempCols = cols;
    for (keyr=0; keyr < rows.length; keyr++) {
        for (var keyc in cols) {
            if( !(rows[keyr] in cols[keyc]['rooms']) ) {
                tempCols[keyc]['rooms'][rows[keyr]] = "";
            }
        }
    }
    cols = tempCols;
    console.log(cols);
    for (keyr=0; keyr < rows.length; keyr++) {
        r = ``;
        r = `
            <div class="row mb-3">
            <div class="col-3 d-flex justify-content-center align-items-center">
                <h3 >${rows[keyr]}</h3>
            </div>`
        for (let keyc of inputs) {
            try {
                r+=`
                    <div class="col-3">
                        ${listify(cols[keyc]['rooms'][rows[keyr]])}
                    </div>
                `;
            }
            catch(err) {
                r+=`
                <div class="col-3"></div>`;
            }
        }
        r+=`</div><hr>`;
        $('#appendRoomInfoHere').append(r);
    }
}

function listify(objectlist) {
    strdList = `<ul class="list-group">`;
    for(let value of Object.values(objectlist)) {
        strdList+=`<li class="list-group-item">${value}</li>`
    }
    return(strdList);
}

$('#compareCard select').on('change', function() {
    inp1 = $('#compareCard').find('select').eq(0).val();
    inp1 = inp1=="None" ? "" : inp1; 
    inp2 = $('#compareCard').find('select').eq(1).val();
    inp2 = inp2=="None" ? "" : inp2; 
    inp3 = $('#compareCard').find('select').eq(2).val();
    inp3 = inp3=="None" ? "" : inp3; 
    updateSelectedColumns(inp1, inp2, inp3);
});
