$(".select-room").change(async function() {
    let target_col = parseInt( $(this).attr('data-target-col') );
    let rid = $(this).find('option:selected').attr('data-rid');
    //console.log(rid);
    let data = await getRoomData(rid);
    putDataInCompare(data, target_col);
    console.log(compare_data);
    updateDisplay(target_col);
    let hideData = !$(".select-room").get().some((el)=>{
        return( typeof $(el).find('option:selected').attr('data-rid') != 'undefined' );
    });
    if(hideData) {
        $("#collapseExample").collapse('hide');
        $("#hint-none").addClass('show');
    }
    else {
        $("#collapseExample").collapse('show');
        $("#hint-none").removeClass('show');
    }
});

function getRoomData(rid) {
    return $.getJSON("/public_assets/modules/php/database/roomControls/getSpecificRoomData.php", {r: rid},
        function (data, textStatus, jqXHR) {
            return data;
        }
    );
}

function putDataInCompare(data, index) {
    if(index>2 || index<0) throw ("Invalid index");
    compare_data[index] = data;
}

function updateDisplay(col) {
    $("#compare-row-roomName div").eq(col+1).html(compare_data[col].name);
    $("#compare-row-rate div").eq(col+1).html(compare_data[col].rate);
    let element_adult = parseInt(compare_data[col].maxAdult)==0 ? "" : `<li>${compare_data[col].maxAdult} <strong>Adult/s</strong></li>`
    let element_children = parseInt(compare_data[col].maxChildren)==0 ? "" : `<li>${compare_data[col].maxChildren} <strong>Children/s</strong></li>`
    $("#compare-row-guest div").eq(col+1).html(`<ul>${element_adult.concat(element_children)}</ul>`);

    //Generating general section entries
    let element_general = "";
    if (Object.keys(compare_data[col].genInfo).length>0)
        for (let item of Object.values(compare_data[col].genInfo))
            element_general = element_general.concat(`<li>${item}</li>`);
    //console.log(element_general);
    $("#compare-row-genInfo div").eq(col+1).html(`<ul>${element_general}</ul>`);

    for (const [key, value] of Object.entries(compare_data[col].sections)) {
        let validID = key.replace(/\s+|\(+|\)+/g,"_");
        let sectionExist = $(`#compare-row-section-${validID}`).length != 0;
        if(sectionExist) {
            let sectionData = getListFromSection(value);
            console.log($(`#compare-row-section-${validID} div`).eq(col+1).html());
            $(`#compare-row-section-${validID} div`).eq(col+1).html(sectionData);
        } else {
            let sectionTemplate = `
            <div id="compare-row-section-${validID}" class="row" data-section-name="${validID}" ><div class="col-3"><h4 class="text-center">${key}</h4></div>
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    
                </div>
            </div>`;
            $("#appendRoomInfoHere").append(sectionTemplate);
            let sectionData = getListFromSection(value);
            console.log(sectionData, validID);
            $(`#compare-row-section-${validID} div`).eq(col+1).html(sectionData);
        }
    }

    let displayedList = $("#compare-row-genInfo").nextAll().map(function(){
        let name = $(this).attr('data-section-name');
        return name;
    }).get();

    /* OLD
    let validSections = new Set($.map(compare_data, (el)=>{
        return Object.keys(el.sections);
    }));
    */
    //console.log(compare_data);
    let validSections = new Set($.map(compare_data, (el) => {
        if(typeof el != 'undefined')
        return $.map(Object.keys(el.sections), name => {
            return name.replace(/\s+|\(+|\)+/g, "_");
        });
    }));

    let thisRoomValidSection =  new Set($.map(Object.keys(compare_data[col].sections), name => {
        return name.replace(/\s+|\(+|\)+/g, "_");
    }));

   // console.log(thisRoomValidSection);

    displayedList.forEach(element => {
        if(!compare_data[col].sections[element])
            //console.log(`#compare-row-section-${element} div`, $(`#compare-row-section-${element} div`).eq(col+1).html(''));
        //console.log(element, validSections);
        if(!validSections.has(element))
            $(`#compare-row-section-${element}`).remove();
            
        if(!thisRoomValidSection.has(element))
            console.log($(`#compare-row-section-${element} div`).eq(col+1).html(''));
        //$(`#compare-row-section-${element} div`).eq(col).html('');
    });
    



}

function getListFromSection($sectionData) {
    let element_section = "";
    for (let item of Object.values($sectionData)) {
        //console.log(item);
        element_section = element_section.concat(`<li>${item}</li>`);
    }
    return `<ul>${element_section}</ul>`;
}

let compare_data = [];