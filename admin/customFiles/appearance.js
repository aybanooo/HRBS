var myCodeMirror = CodeMirror(document.getElementById('appendTextEditor'), {
    mode:  "css",
    lineNumbers: true,
    gutters: ["CodeMirror-lint-markers"],
    lint: true
  });

myCodeMirror.setSize("100%", 500);

var widgets = [];
function updateHints() {
myCodeMirror.operation(function(){
    for (i = 0; i < widgets.length; ++i)
    myCodeMirror.removeLineWidget(widgets[i]);
    widgets.length = 0;

    JSHINT(myCodeMirror.getValue());
    for (i = 0; i < JSHINT.errors.length; ++i) {
    var err = JSHINT.errors[i];
    if (!err) continue;
    var msg = document.createElement("div");
    var icon = msg.appendChild(document.createElement("span"));
    icon.innerHTML = "!!";
    icon.className = "lint-error-icon";
    msg.appendChild(document.createTextNode(err.reason));
    msg.className = "lint-error";
    widgets.push(myCodeMirror.addLineWidget(err.line - 1, msg, {coverGutter: false, noHScroll: true}));
    }
});
var info = myCodeMirror.getScrollInfo();
var after = myCodeMirror.charCoords({line: myCodeMirror.getCursor().line + 1, ch: 0}, "local").top;
if (info.top + info.clientHeight < after)
    myCodeMirror.scrollTo(null, after - info.clientHeight + 3);
}

loadAppearance()

function loadAppearance() {
    $.ajax({
        type: 'post',
        url: 'customFiles/php/appearance/loadCustomStyle.php',
        async: false,
        success: function (response) {
            myCodeMirror.setValue(response);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function saveAppearance() {
    console.log();

    $.ajax({
        type: 'post',
        url: 'customFiles/php/appearance/saveCustomStyle.php',
        data: {
            textContent: myCodeMirror.getValue()
        },
        async: false,
        success: function (response) {
            console.log(response);
            if(parseInt(response)) {
                Toast.fire({
                    icon: 'success',
                    title: 'Custom style have been saved.\nPlease refresh the page to see the changes.'
                    });
            }

            else {
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to save custom style.'
                    });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });

}
