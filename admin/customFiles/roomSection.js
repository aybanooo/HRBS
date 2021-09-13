var sec = {

    living_room : {
      name : 'Living Room',
      tabIcon : 'fas fa-couch'
    },
  
    bed_room : {
      name : 'Bedroom',
      tabIcon : 'fas fa-bed'
    },
  
    bath_room : {
      name : 'Bath Room',
      tabIcon : 'fas fa-shower'
    },
  
    dining_room : {
      name : 'Dining Room',
      tabIcon : 'fas fa-utensils'
    },
  }

function modalOptions() {

target = document.getElementById('roomSectionModal').querySelector('.modal-body');
var checkThisElement = document.getElementById('roomSection-tab');
  
document.getElementById('buttonList').innerHTML = " ";

  Object.keys(sec).forEach(function(key) {
    if(!document.getElementById('roomSection-'+ key +'-tab')) {
      console.log(sec[key].name + " is not here!");
      generateModalButton(key);
    }
  });

}

function generateModalButton(key) {
  
  var button = document.createElement('button');
  button.type = 'button';
  button.className = 'btn btn-outline-primary btn-block';
  button.setAttribute('onclick', "addTabAndContent(\'" + key + "\')");
  
  var i = document.createElement('i');
  i.className = sec[key].tabIcon + ' mr-2';
  button.appendChild(i);
  button.innerHTML += sec[key].name;
  
  document.getElementById('buttonList').appendChild(button);
}
    
function removeSection(id) {
  document.querySelector('.nav-link.hoverable-fas-icon.active').parentElement.remove();
  document.querySelector('.tab-pane.fade.active.show').remove();
  document.getElementById('roomSection-genInfo-tab').classList.toggle('active');
  document.getElementById('roomSection-genInfo').classList.toggle('active');
  document.getElementById('roomSection-genInfo').classList.toggle('show');
  $(`#roomSection-${id}`).remove();
  $(`#roomSection-${id}-tab`).parent().remove();

  delete queries.insert.items[id];
  delete queries.delete.items[id];
  delete queries.update.items[id];
  
  delete queries.insert.gallery[id];
  delete queries.delete.gallery[id];
  delete queries.update.gallery[id];

  queries.delete.sections.push(id);
}

function addTabAndContent(key) {
  var id = 'roomSection-'+ key +'-tab';
  var icon = sec[key].tabIcon + ' fa-2x';
  var targID = 'roomSection-' + key;
  var name = sec[key].name;
  var labelID = 'roomSection-'+ key +'-tab';
  generateTabButton(id, icon, targID);
  generateTabContent(targID, labelID, name);
  modalOptions();
}

function generateTabButton(id, icon, targetID) {

  //content setup
  var li = document.createElement('li');
  li.setAttribute('class', 'nav-item');

  var remove = document.createElement('span');
  remove.setAttribute('class', 'fas fa-times');
  remove.setAttribute('data-target', id);
  remove.setAttribute('data-target-icon', icon);

  var a = document.createElement('a');
  a.setAttribute('class', 'nav-link hoverable-fas-icon saveSectionFirst');
  a.setAttribute('id', id);
  a.setAttribute('role', 'tab');
  a.setAttribute('aria-controls', targetID);
  a.setAttribute('aria-selected', 'false');
  a.setAttribute('data-placement', "bottom");
  a.setAttribute('title', "Save the changes first to modify new section/s.");
  a.setAttribute('data-toggle', 'tooltip');
  a.setAttribute('new', '');

  var i = document.createElement('i');
  i.setAttribute('class', icon+" fa-2x");
  //content setup end

  //arrange elements
  a.appendChild(i);
  li.appendChild(a);
  li.appendChild(remove);
  //arrange elements end

  //append to page
  document.getElementById('roomSection-tab').querySelector('li:last-child').before(li);

}

function generateTabContent(id, labelID, name) {

  // content setup
  var divElement = document.createElement('div');
  var rowLabelClass = 'row d-flex justify-content-between';

  var tabPane = divElement.cloneNode(false);
  tabPane.setAttribute('class', 'tab-pane fade');
  tabPane.setAttribute('id', id);
  tabPane.setAttribute('role', 'tabpanel');
  tabPane.setAttribute('aria-labelledby', labelID);

  var container = divElement.cloneNode(false);
  container.setAttribute('class','container-fluid p-3');

  var rowRoomInfoLabel = divElement.cloneNode(false);
  rowRoomInfoLabel.setAttribute('class', rowLabelClass);
  rowRoomInfoLabel.innerHTML = '<label>'+ name +' Info<a onclick="addInfo(event)"><i class="fas fa-plus pl-2"></i></a></label>'+
  '<a href="javascript: void(0)" class="hoverable-danger" onclick="removeSection()">Remove Section</a>';

  var rowRoomInfoList = divElement.cloneNode(false);
  rowRoomInfoList.setAttribute('class', 'row mx-1 mx-sm-5 my-sm-2');

  var colRoomInfoList = divElement.cloneNode(false);
  colRoomInfoList.setAttribute('class', 'col-12 ce-limit ce-noenter ce-blankremove');
  colRoomInfoList.innerHTML = '<ul class="list-unstyled row gen-info-list"></ul>';

  var rowGalleryLabel = divElement.cloneNode(false);
  rowGalleryLabel.setAttribute('class', rowLabelClass);
  rowGalleryLabel.innerHTML = '<label>Gallery<a onclick="addImage(event)"><i class="fas fa-plus pl-2"></i></a></label>';

  var rowGalleryContent = divElement.cloneNode(false);
  rowGalleryContent.setAttribute('class', 'row gallery-row');
  // content setup end

  // arrange contents
  container.appendChild(rowRoomInfoLabel);
  rowRoomInfoList.appendChild(colRoomInfoList);
  container.appendChild(rowRoomInfoList);
  container.appendChild(rowGalleryLabel);
  container.appendChild(rowGalleryContent)
  tabPane.appendChild(container);
  // arrange contents end


  console.log(tabPane);
  //console.log(document.getElementById('roomSection-tabContent').innerHTML);
  // add to tabContent
  document.getElementById('roomSection-tabContent').appendChild(tabPane);  
}

function createNewSection() {
  /*
  secName = document.getElementById('sectionName').value;
  icon = 'fas '+document.getElementById('iconName').value;
  newID = secName.toLowerCase().replace(" ", "_");
  console.log(secName + " " + icon + " " + newID);
  if ( typeof sec[newID] !== 'undefined' || secName == '') {
    console.log("already in list");
	} else {
		sec[newID] = {
      "name" : secName,
      "tabIcon" : icon
    }
    modalOptions();
	}
  console.log(sec);
  */

  secName = document.getElementById('sectionName').value;
  icon = document.getElementById('iconName').value;
  enlargedIcon = icon+" fa-2x";
  console.log(icon);
  generateTabButton(secName, icon, "");
  $('[data-toggle="tooltip"]').tooltip();   
  
  queries.insert.sections.push({sectionName: secName, sectionIcon: icon});

}
