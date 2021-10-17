const toggleButtonDisabled = (selector = null, disableBtnScopeSelector = "*", disabledText = "Loading...") => {

    if(selector==null || !(typeof selector == "string" || typeof selector == "object") )
        console.log("Invalid");
    selector = $(selector);
    disableBtnScopeSelector = disableBtnScopeSelector.trim();
    disableBtnScopeSelector = disableBtnScopeSelector == "" || disableBtnScopeSelector == null ? "*" : disableBtnScopeSelector;
    if(typeof $(disableBtnScopeSelector+" .btn").prop('disabled')==="undefined" || $(disableBtnScopeSelector+" .btn").prop('disabled') == false) {
      $(disableBtnScopeSelector +" .btn").prop('disabled', true);
      //$(selector + " > span").addClass('d-none');
      //console.log("pasok");
      selector.find("*").addClass('d-none');
      if(disabledText)
      selector.append('<span class="disabledText ml-2">'+disabledText+'</span>');
      selector.prepend(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);
    } else {
      $("#btn-changeSelection").attr('disabled', '');
      selector.find(".spinner-border").remove();
      selector.find(".disabledText").remove();
      selector.find("*").removeClass('d-none');
      //$(selector + " > span").removeClass('d-none');
      $(disableBtnScopeSelector+" .btn").prop('disabled', false);
    }
}