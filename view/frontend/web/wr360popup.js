function wr360QueryGetParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

jQuery(document).ready(function() {
    var popup360Elm = jQuery("#wr360PlayerId20");
    if (popup360Elm.length == 1) {
        var configHeight = parseInt(wr360QueryGetParameterByName("height"));
        var iframeHeight = configHeight;

        var iframeElm = jQuery("#wr360frame_id", window.parent.document);
        if (iframeElm.length > 0)
            iframeHeight = iframeElm.attr("height");

        var realHeight = (iframeHeight < configHeight) ? iframeHeight : configHeight;
        jQuery(".viewerbox").css("height", realHeight + "px");

        popup360Elm.rotator( {
            licenseFileURL: wr360QueryGetParameterByName("lic"),
            graphicsPath: wr360QueryGetParameterByName("grphpath"),
            configFileURL: wr360QueryGetParameterByName("config"),
            rootPath: wr360QueryGetParameterByName("root"),
            googleEventTracking: wr360QueryGetParameterByName("analyt")
        });
    }
});


