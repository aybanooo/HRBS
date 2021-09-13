
function update360preview() {
    urlString = window.location.href;
    var url = new URL(urlString);
    var c = url.searchParams.get("image");
    $('a-sky').attr('src', c);
    console.log();
}
