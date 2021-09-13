function toggle360(evt, sectionID, id, isNew = false) {
    //$('imageModaler')
    target = $(evt.currentTarget).parents().eq(3);
    badge = target.find('.badge-secondary');
    toggler = target.find('.imageModaler');
    toggler.toggleClass('pano360');
    if(toggler.hasClass('pano360')) {
        badge.removeClass('d-none');
        if(isNew) {
            queries.insert.gallery[sectionID][id].is360 = true;
        } else {
            if(!queries.update.gallery[sectionID])
                queries.update.gallery[sectionID] = {}; 
            queries.update.gallery[sectionID][id] = {"is360": true};
            console.log("old image to.");
        }
    }
    else{
        badge.addClass('d-none');
        if(isNew) {
            queries.insert.gallery[sectionID][id].is360 = false;
        } else {
            if(!queries.update.gallery[sectionID])
                queries.update.gallery[sectionID] = {}; 
            queries.update.gallery[sectionID][id] = {"is360": false};
            console.log("old image to.");
        }
    }

}