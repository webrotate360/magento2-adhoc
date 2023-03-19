<?php

namespace WebRotate360\ProductViewerAdHoc\Helper;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLED          = 'webrotate360adhoc/general/enabled';
    const XML_PATH_EMBEDDED         = 'webrotate360adhoc/general/embedded';
    const XML_PATH_PLACEHOLDER      = 'webrotate360adhoc/general/placeholder';
    const XML_PATH_VIEWER_WIDTH     = 'webrotate360adhoc/general/viewer_width';
    const XML_PATH_VIEWER_HEIGHT    = 'webrotate360adhoc/general/viewer_height';
    const XML_PATH_BASE_WIDTH       = 'webrotate360adhoc/general/base_width';
    const XML_PATH_MIN_HEIGHT       = 'webrotate360adhoc/general/min_height';
    const XML_PATH_VIEWER_SKIN      = 'webrotate360adhoc/general/viewer_skin';
    const XML_PATH_PRETTY_THEME     = 'webrotate360adhoc/general/pretty_theme';
    const XML_PATH_POPUP_MODE       = 'webrotate360adhoc/general/popup_mode';
    const XML_PATH_POPUP_ICON       = 'webrotate360adhoc/general/popup_icon';
    const XML_PATH_MEDIA_URL        = 'webrotate360adhoc/general/media_url_config';
    const XML_PATH_USE_ANALYTICS    = 'webrotate360adhoc/advanced/use_analytics';
    const XML_PATH_API_CALLBACK     = 'webrotate360adhoc/advanced/api_callback';
    const XML_PATH_MASTER_CONFIG    = 'webrotate360adhoc/advanced/master_config';
    const XML_PATH_LICENSE          = 'webrotate360adhoc/advanced/license';
    const XML_PATH_GRAPHICS_PATH    = 'webrotate360adhoc/advanced/graphics_path';

    const POPUP_MODE_LIGHTBOX       = 'LIGHTBOX';
    const POPUP_MODE_FULLSCREEN     = 'FULLSCREEN';
    const POPUP_MODE_BROWSER_WINDOW = 'BROWSER_WINDOW';

    private $_objectManager = null;
    private $_currProduct   = null;
    private $_storeManager  = null;
    private $_assetRepo     = null;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->_storeManager = $storeManager;
        $this->_assetRepo = $assetRepo;

        parent::__construct($context);
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getWebrotatePath()
    {
        if (!$this->_objectManager)
            $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        if (!$this->_currProduct)
            $this->_currProduct = $this->_objectManager->get('Magento\Framework\Registry')->registry('current_product');

        if ($this->_currProduct)
            return ltrim($this->_currProduct->getData('webrotate_path') ?? '', '/');

        return '';
    }

    public function getWebrotateRootUrl()
    {
        if (!$this->_objectManager)
            $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        if (!$this->_currProduct)
            $this->_currProduct = $this->_objectManager->get('Magento\Framework\Registry')->registry('current_product');

        if ($this->_currProduct)
            return (string)$this->_currProduct->getData('webrotate_root');

        return '';
    }

    public function getGraphicsPathUrl()
    {
        $graphicsPath = $this->scopeConfig->getValue(self::XML_PATH_GRAPHICS_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!empty($graphicsPath)) {
            return $graphicsPath;
        }

        return (string)$this->_assetRepo->getUrl('WebRotate360_ProductViewerAdHoc::graphics/');
    }

    public function getUseMediaUrlConfig()
    {
        return (bool)$this->scopeConfig->getValue(self::XML_PATH_MEDIA_URL, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getFrameUrl()
    {
        return $this->_assetRepo->getUrl('WebRotate360_ProductViewerAdHoc::frame_' . $this->getViewerSkin() . '.html');
    }

    public function getPopupIconUrl()
    {
        $value = $this->getPopupIcon();
        if (empty($value))
            return $this->_assetRepo->getUrl('WebRotate360_ProductViewerAdHoc::360thumb.svg');

        return $value;
    }

    public function getPopupSkinUrl()
    {
        return $this->_assetRepo->getUrl('WebRotate360_ProductViewerAdHoc::prettyPhoto/css/prettyphoto.css');
    }

    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isEmbedded()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_EMBEDDED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getPlaceholder()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PLACEHOLDER, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getViewerWidth()
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_VIEWER_WIDTH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($this->isEmbedded())
            return $value;

        return preg_replace("/[^0-9]/", "" , (string)$value);
    }

    public function getViewerHeight()
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_VIEWER_HEIGHT, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($this->isEmbedded())
            return $value;

        return preg_replace("/[^0-9]/", "" , (string)$value);
    }

    public function getBaseWidth()
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_BASE_WIDTH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (empty($value))
            return 0;

        return preg_replace("/[^0-9]/", "" , (string)$value);
    }

    public function getMinHeight()
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_MIN_HEIGHT, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (empty($value))
            return 0;

        return preg_replace("/[^0-9]/", "" , (string)$value);
    }

    public function getViewerSkin()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_VIEWER_SKIN, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getViewerSkinUrl()
    {
        return $this->_assetRepo->getUrl('WebRotate360_ProductViewerAdHoc::imagerotator/html/css/' . $this->getViewerSkin() . '.css');
    }

    public function getPrettyTheme()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PRETTY_THEME, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getPopupIcon()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_POPUP_ICON, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getPopupMode()
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_POPUP_MODE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        switch ($value)
        {
            case 'fullScreen':
                return self::POPUP_MODE_FULLSCREEN;
            case 'browserWindow':
                return self::POPUP_MODE_BROWSER_WINDOW;
            default:
                return self::POPUP_MODE_LIGHTBOX;
        }
    }

    public function isUseAnalytics()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_USE_ANALYTICS, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getApiCallback()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_CALLBACK, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMasterConfigUrl()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_MASTER_CONFIG, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getLicense()
    {
        $licPath = $this->scopeConfig->getValue(self::XML_PATH_LICENSE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!empty($licPath))
            return (string)$licPath;
        return (string)$this->_assetRepo->getUrl('WebRotate360_ProductViewerAdHoc::imagerotator/license.lic');
    }
}
