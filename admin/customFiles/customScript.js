function openTab(evt, tabNum) {
  evt.currentTarget.parentElement.querySelector('.active').classList.toggle('active');
  evt.currentTarget.classList.toggle('active');
  var x = evt.currentTarget.parentElement.parentElement.children[tabNum];
  if (!x.classList.contains('active')) {
    evt.currentTarget.parentElement.parentElement.querySelector('.timetabCardContent.active').classList.toggle('active');
    x.classList.toggle('active');
  }
}

function dimRooms() {
    document.getElementById('roomTable').querySelectorAll('tbody td > div:first-child').forEach(function(el) {
        el.style.background = el.style.background.includes('linear-gradient') ?  el.style.background : "linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), " + el.style.background;
      });
}

function delRoomInList(evt, roomID) {
  //evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
  
  $.ajax({
    type: "post",
    url: "customFiles/php/database/roomControls/deleteRoom.php",
    data: {
      roomID: roomID
    },
    async: false,
    success: function (response) {
      response = JSON.parse(response);
      //console.log(response);
      if (response.isSuccessful)
        tbl.row($(evt).parentsUntil("tr")).remove().draw(false);
      Toast.fire({
        icon: response.isSuccessful ? "success" : "error",
        title: response.isSuccessful ? "Room has been sucessfuly deleted." : "Failed to delete room. "+response.error.desc
      });
      refreshManageRoomNumSelectElements();
    }
  });
  
}

function addRoomSection() {
  alert("gegege");
}

function toggleCardDesign(evt) {
  var parentCard = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement;
  parentCard.classList.toggle('card-outline');
  parentCard.classList.toggle('card-primary');
}

function putDesignToggleBtn() {
  var cardCount=0;
  document.getElementById('rateCards').querySelectorAll('.card-tools').forEach(
    function(el) {
      if(cardCount==0){
        cardCount++;
        return;
      }
      el.innerHTML = String.raw`<button type="button" class="btn btn-tool cardToggleFix">
      <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" id="designToggler`+ cardCount + String.raw`" onclick="toggleCardDesign(event)">
      <label class="custom-control-label" for="designToggler`+ cardCount + String.raw`">
      </label></div></button><button type="button" class="btn btn-tool" onclick="removeCard(event)"><i class="fas fa-times"></i>
      </button>`;
      cardCount++;
    });
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});


function addRate() {
  var col = document.createElement("div");
  col.className = "col-12 col-md-4";
  var card = document.createElement("div");
  card.className = "card inflate";
  var cardHeader = document.createElement('div');
  cardHeader.className = 'card-header';
  cardHeader.innerHTML = String.raw`<h3 class="card-title" contenteditable="True">Rate Name</h3>
                          <div class="card-tools"></div>`;
  var cardBody = document.createElement('div');
  cardBody.className = 'card-body  ce-shiftenter';
  cardBody.innerHTML = '<p contenteditable="True" class="m-0">Rate Description</p>';
  var cardFooter = document.createElement('div');
  cardFooter.className = 'card-footer ce-limit ce-numOnly';
  cardFooter.innerHTML = ' <span class="priceTag" >Php&nbsp;<span contenteditable="True">0</span></span>';

  card.appendChild(cardHeader);
  card.appendChild(cardBody);
  card.appendChild(cardFooter);
  col.appendChild(card);
  document.querySelector('#rateCards').appendChild(col);
  putDesignToggleBtn();
}

function removeCard(evt) {
  var card = evt.currentTarget.parentElement.parentElement.parentElement;
  card.classList.add('deflate');
  setTimeout(function() {card.parentElement.remove();}, 400);
  ;
}

function addInfo(evt) {
  var li = document.createElement('li');
  li.className = 'list-item col-6 col-md-3';
  li.innerHTML = String.raw`
  <div class="row">
      <div class="col-auto p-0">
        <i class="fas fa-check mx-1"></i>
      </div>
      <div class="col">
        <span contenteditable="True" newinfo>New Entry</span>
      </div>
    </div>`;
  evt.currentTarget.parentElement.parentElement.nextElementSibling.querySelector('.gen-info-list').appendChild(li);
}


function enlargeImage(evt) {
  alert("gegege");
}

function generateEllipse() {
  var ellipseElement = `
  <div class="btn-group dropleft">
    <a href="javascript: void(0)" data-toggle="dropdown" aria-expanded="false">
      <span><i class="fas fa-ellipsis-v"></i></span>
    </a>
    <ul class="dropdown-menu" style="">
      <li>
        <a class="dropdown-item" onclick="" href="javascript: void(0)">Change Image</a>
      </li>
      <li>
        <a class="dropdown-item" onclick="toggle360(event)" href="javascript: void(0)">Toggle 360</a>
      </li>
      <li>
        <a class="dropdown-item" onclick="deleteImageEntry(event)" href="javascript: void(0)">Delete</a>
        </li>
      </ul>
    </div>
  `;

  var ellipse = document.createElement('div');
  ellipse.className = 'btn-group dropleft';

  var aIcon = document.createElement('a');
  aIcon.href = 'javascript: void(0)';
  aIcon.setAttribute('data-toggle', 'dropdown');

  var icon = document.createElement('span');
  var i = document.createElement('i');
  i.setAttribute('class','fas fa-ellipsis-v');
  icon.appendChild(i);

  var ul = document.createElement('ul');
  ul.className = 'dropdown-menu';

  var li1 = document.createElement('li');
  var li2 = document.createElement('li');
  var li3 = document.createElement('li');

  var a1 = document.createElement('a');
  var a2 = document.createElement('a');
  var a3 = document.createElement('a');
  a1.className = 'dropdown-item';
  a2.className = 'dropdown-item';
  a3.className = 'dropdown-item';
  a1.setAttribute('onclick', '');
  a2.setAttribute('onclick', 'toggle360(event)');
  a3.setAttribute('onclick', 'deleteImageEntry(event)');
  a1.href = 'javascript: void(0)';
  a2.href = 'javascript: void(0)';
  a3.href = 'javascript: void(0)';
  a1.innerHTML = 'Change Image';
  a2.innerHTML = 'Toggle 360';
  a3.innerHTML = 'Delete';

  aIcon.appendChild(icon);
  li1.appendChild(a1);
  li2.appendChild(a2);
  li3.appendChild(a3);
  ul.appendChild(li1);
  ul.appendChild(li2);
  ul.appendChild(li3);
  ellipse.appendChild(aIcon);
  ellipse.appendChild(ul)
  /*
  var els = document.getElementsByClassName('.gallery-row');
  [].forEach.call(els, function (el) {
    el.querySelector('.card-img-overlay').forEach(function(el) {
    alert(el.innerHTML);
  });
  });
  */

  var i = 0;

  document.querySelectorAll('.gallery-row .card-img-overlay').forEach(function(el) {
    if(!el.querySelector('.btn-group'))
      el.appendChild(ellipse.cloneNode(true)); 
  });
}

function deleteImageEntry(evt, sectionID, id, isNew = false) {
  //var targ = evt.currentTarget.parentElement.parentElement.parentElement.parentElement;
  //alert(targ.previousElementSibling.className);
  var targ = evt.currentTarget.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
  //
  targ.remove();
  if(isNew) {
    delete queries.insert.gallery[sectionID][id];
    if(Object.keys(queries.insert.gallery[sectionID]).length == 0)
      delete queries.insert.gallery[sectionID];
    return;
  }

  if(!queries.delete.gallery[sectionID])
    queries.delete.gallery[sectionID] = []

  if(queries.update.gallery[sectionID]) {
    delete queries.update.gallery[sectionID][id];
    if(Object.keys(queries.update.gallery[sectionID]).length == 0)
      delete queries.update.gallery[sectionID]
  }


  queries.delete.gallery[sectionID].push(id);
  

}

function addImage(evt) {
  var imageEntry = document.createElement('div');
  imageEntry.className = 'col-md-12 col-lg-6 col-xl-4';
  imageEntry.innerHTML = String.raw`
    <div class="card mb-2">
      <img class="card-img-top rounded" src="dist/img/default-image.jpg" alt="Dist Photo 3">
      <div class="card-img-overlay">
        <span class="imageModaler" style="display: inline-block; position: relative; width: 100%; height: 100%;"></span>
        <span class="badge badge-secondary d-none">360°</span>
      </div>
    </div>`;
  var targ = evt.currentTarget.parentElement.parentElement.nextElementSibling;
  targ.appendChild(imageEntry);
  generateEllipse();
}


function addRoomEntry(roomID , roomName, roomDescription = "Description of the room...") {
  var targetElem = document.getElementById('roomTable').querySelector('tbody');
  
  var tr = document.createElement('tr');

  var td = document.createElement('td');
  td.style = 'word-break:break-all;';
  
  var mainDiv = document.createElement('div');
  mainDiv.className = 'container-fluid bg-white rounded p-3 room-container';
  mainDiv.style = 'background: url(\'/public_assets/rooms/'+roomID+'/'+roomID+'-cover.jpg\') no-repeat left center /cover';

  var mainRow = document.createElement('div');
  mainRow.className = 'row';

  var mainCol = document.createElement('div');
  mainCol.className = 'col-12 bg-fadegray';

// Head Row
  var headRow = document.createElement('div')
  headRow.className = 'row';

  var headCol = document.createElement('div');
  headCol.className = 'col-lg-12';

  var divHead = document.createElement('div');
  divHead.className = 'row roomManagementHeadRow';

  // Room Name Column
    var titleCol = document.createElement('div');
    titleCol.className = 'col-12 col-sm-6';

    var h3 = document.createElement('h3');
    h3.innerText = roomName;

    titleCol.appendChild(h3);
  // Room Name Column End

  // Room Buttons
    var buttonCol = document.createElement('div');
    buttonCol.className = ' col-12 col-sm-6';

    var a1 = document.createElement('a');
    a1. className = 'btn btn-app float-right';
    a1.setAttribute('href', './rooms/'+roomID);
    
    var i1 = document.createElement('i');
    i1.className = 'fas fa-edit';

    var a1Text = document.createTextNode('Edit');

    a1.appendChild(i1);
    a1.appendChild(a1Text);

    var a2 = document.createElement('a');
    a2.className = 'btn btn-app float-right';
    a2.setAttribute('onclick', `delRoomInList(this, ${roomID})`);

    var i2 = document.createElement('i');
    i2.className = 'fas fa-trash';

    var a2Text = document.createTextNode('Delete');
    
    a2.appendChild(i2);
    a2.appendChild(a2Text);

    buttonCol.appendChild(a1);
    buttonCol.appendChild(a2);
  // Room Buttons End
  divHead.appendChild(titleCol);
  divHead.appendChild(buttonCol);
  headCol.appendChild(divHead);
  headRow.appendChild(headCol);
// Head Row End

// Body Row
  var bodyRow = document.createElement('div');
  bodyRow.className = 'row p-3 ellips';

  var p = document.createElement('div');
  p.innerText = roomDescription;

  bodyRow.appendChild(p);
// Body Row End

mainCol.appendChild(headRow);
mainCol.appendChild(bodyRow);
mainRow.appendChild(mainCol);
mainDiv.appendChild(mainRow);
td.appendChild(mainDiv);
tr.appendChild(td);
//targetElem.appendChild(tr);
return tr;
//dimRooms();
//suspect sa DATATABLE ERROR!!!!!!!!!!!!!!!!!!!!
//$('#roomTable').DataTable().ajax.reload();
}


function removeAmenityCard(evt) {
  var card = evt.currentTarget.parentElement.parentElement.parentElement;
 card.parentElement.parentElement.parentElement.remove();
  ;
}

function deleteAmenityImage(evt) {
  var target = evt.currentTarget.parentElement.parentElement.parentElement.querySelector('img');
  target.setAttribute('src', 'dist/img/default-image.jpg');
}

function addAmenityEntry() {
/* 
  <div class="form-group m-0">
    <textarea class="form-control" rows="3" placeholder="Enter amenity description"></textarea>
  </div>
  */

  var tr = document.createElement('tr');

  var td = document.createElement('td');
  td.className = 'word-break:break-all';

  var mainRow = document.createElement('div');
  mainRow.className = 'row';

  var mainCol = document.createElement('div');
  mainCol.className = 'col-12';

  var mainCard = document.createElement('div');
  mainCard.className = 'card card-outline ce-noblank overflow-hidden';

  var mainCardHead = document.createElement('div');
  mainCardHead.className = 'card-header ce-noenter ce-limit';

    var h3 = document.createElement('h3');
    h3.className = 'card-title amenity';
    h3.setAttribute('contenteditable', 'True');
    h3.innerText = 'Amenity Name';

    var cardTools = document.createElement('div');
    cardTools.className = 'card-tools';
    
      var button = document.createElement('button');
      button.className = 'btn btn-tool';
      button.setAttribute('type', 'button');
      button.setAttribute('onclick', 'removeAmenityCard(event)');

        var i = document.createElement('i');
        i.className = 'fas fa-times';
        
        button.appendChild(i);
      
      cardTools.appendChild(button);
    
    mainCardHead.appendChild(h3);
    mainCardHead.appendChild(cardTools);
    
  var mainCardBody = document.createElement('div');
  mainCardBody.className = 'card-body p-0';

  var mainTextAreaDiv = document.createElement('div');
  mainTextAreaDiv.className = 'form-group m-0';

  var textarea = document.createElement('textarea');
  textarea.setAttribute('rows','3');
  textarea.setAttribute('placeholder', 'Enter amenity description');

  mainTextAreaDiv.append(textarea);

    var imgCard = document.createElement('div');
    imgCard.className = 'card m-0 bg-gradient-dark';

      var img = document.createElement('img');
      img.className = 'card-img-top rounded';
      img.setAttribute('src', 'dist/img/default-image.jpg');
      img.setAttribute('alt', 'Image');

      var cardImgOverlay = document.createElement('div');
      cardImgOverlay.className = 'card-img-overlay d-flex flex-column justify-content-end';
      
        var container = document.createElement('div');
        container.className = 'container-fluid p-0';

          var a1 = document.createElement('a');
          a1.className = 'btn btn-app mb-0 ml-0'

            var i1 = document.createElement('i');
            i1.className = 'fas fa-edit';
            var a1Text = document.createTextNode('Change')
            a1.appendChild(i1);
            a1.appendChild(a1Text);
          
          var a2 = document.createElement('a');
          a2.className = 'btn btn-app mb-0'
            
            var i2 = document.createElement('i');
            i2.className = 'fas fa-trash';
            var a2Text = document.createTextNode('Delete')
            a2.appendChild(i2);
            a2.appendChild(a2Text);

          container.appendChild(a1);
          container.appendChild(a2);
        
        cardImgOverlay.appendChild(container);
      
      imgCard.appendChild(img);
      imgCard.appendChild(cardImgOverlay);

    mainCardBody.appendChild(mainTextAreaDiv);
    mainCardBody.appendChild(imgCard);

  mainCard.appendChild(mainCardHead);
  mainCard.appendChild(mainCardBody);
  mainCol.appendChild(mainCard);
  mainRow.appendChild(mainCol);
  td.appendChild(mainRow);
  tr.appendChild(td);

  var target = document.querySelector('#amenityTable tbody');
  target.insertBefore(tr, target.childNodes[0]);
}

function removeNewAccImg() {
  document.querySelector('#newAccImg').setAttribute('src', './dist/img/default-profile-icon.jpg')
}

$('#accountTable').on('click', '.changeAccRole', function() {
  ActiveRole = $(this).text();
  empID = $(this).attr('data-value');
  $('#empIDChangeRole').val(empID);
  selects = $('#inputRole').clone();
  target = $('#inputChangeRole');
  target.empty();
  target.append(selects);
  target.find('select').val(ActiveRole);
});

var tbl = $('#accountTable tr:has(td)').map(function(i, v) {
  var $td =  $('td', this);
      return {
               id: ++i, 
               empID: $td.eq(1).text(),
               email: $td.eq(2).text(),
               name: $td.eq(3).text()  ,
               role: $td.eq(4).text()               
             }
}).get();

//console.log(tbl);