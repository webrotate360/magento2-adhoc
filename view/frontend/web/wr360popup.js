function wr360QueryGetParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

jQuery(document).ready(function() {
    var popup360Elm = jQuery("#wr360PlayerId20");
    if (popup360Elm.length == 1) {
        popup360Elm.rotator( {
            licenseFileURL: wr360QueryGetParameterByName("lic"),
            graphicsPath: wr360QueryGetParameterByName("grphpath"),
            configFileURL: wr360QueryGetParameterByName("config"),
            rootPath: wr360QueryGetParameterByName("root"),
            googleEventTracking: wr360QueryGetParameterByName("analyt") === "1"
        });
    }
});


