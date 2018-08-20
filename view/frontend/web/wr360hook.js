function WR360AdhocEmbedInitialize(cfg) {
    var imageDiv = jQuery(cfg.pagePlaceholder);
    if (imageDiv.length != 1)
        return;

    imageDiv.css("padding", 0);
    imageDiv.html("<div class='wr360wrap'><div id='wr360PlayerId'></div></div>");
    var wrapElm = jQuery('.wr360wrap');

    if (cfg.viewerWidth.length > 0)
        wrapElm.css("width", cfg.viewerWidth);
    if (cfg.viewerHeight.length > 0)
        wrapElm.css("height", cfg.viewerHeight);

    imageDiv.css("visibility", "visible");

    var ir = WR360.ImageRotator.Create("wr360PlayerId");

    ir.settings.graphicsPath         = cfg.graphicsPath;
    ir.settings.configFileURL        = cfg.confFileURL;
    ir.settings.rootPath             = cfg.rootPath;
    ir.settings.responsiveBaseWidth  = parseInt(cfg.baseWidth);
    ir.settings.responsiveMinHeight  = parseInt(cfg.minHeight);
    ir.settings.googleEventTracking  = cfg.useAnalytics;
    ir.licenseFileURL                = cfg.licensePath;

    if (cfg.apiCallback.length > 0) {
        var fn = window[cfg.apiCallback];
        if (typeof fn === "function")
            ir.settings.apiReadyCallback = fn;
    }

    ir.runImageRotator();
}

function WR360AdhocFullScreenClickInitialize(cfg) {
    var imageBlock = jQuery(cfg.pagePlaceholder);
    if (imageBlock.length <= 0)
        return;

    var newHtml = "<div id='wr360FSOnClick' style='cursor:pointer;'><img src='" + cfg.thumbPath + "'/></div>";
    imageBlock.html(newHtml);
    imageBlock.css("visibility", "visible");

    var ir = WR360.ImageRotator.Create("wr360FSOnClick");
    if (ir == null)
        return;

    ir.licenseFileURL               = cfg.licensePath;
    ir.settings.graphicsPath        = cfg.graphicsPath;
    ir.settings.configFileURL       = cfg.configFileURL;
    ir.settings.rootPath            = cfg.rootPath;
    ir.settings.fullScreenOnClick   = true;
    ir.settings.inBrowserFullScreen = cfg.inBrowser;
    ir.settings.googleEventTracking = cfg.useAnalytics;

    if (cfg.apiCallback.length > 0) {
        var fn = window[cfg.apiCallback];
        if (typeof fn === "function")
            ir.settings.apiReadyCallback = fn;
    }

    ir.runImageRotator();
}

function WR360AdhocPopupInitialize(placeholder, framePath, thumbPath, prettyTheme) {
    var imageBlock = jQuery(placeholder);
    if (imageBlock.length <= 0)
        return;

    var newHtml = "<a href='" + framePath + "'" + "data-rel='prettyPhoto'><img src='" + thumbPath + "'/></a>";
    imageBlock.html(newHtml);
    imageBlock.css("visibility", "visible");

    /*
    if (prettyTheme == "pp_default") {
        jQuery("a[rel^='prettyPhoto']").prettyPhoto( {
            deeplinking: false,
            animation_speed: 0
        });
    }
    else */ {
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto( {
            theme: prettyTheme,
            deeplinking: false,
            animation_speed: 0
        });
    }
}


