<?php

namespace Tiendamia\Challenge\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\State as AppState;
use Magento\Framework\App\Area;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class UpdateHomePageContent implements DataPatchInterface
{
    public function __construct(
        private \Magento\Cms\Model\PageRepository $pageRepository
    ) {}

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->updateHomePage();
    }

    private function updateHomePage() {
       $homePage = $this->pageRepository->getById(2);

        $htmlContent = <<<HTML
<style>
    #html-body [data-pb-style=O4GRI2C] {
        justify-content: flex-start;
        display: flex;
        flex-direction: column;
        background-position: left top;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: scroll
    }
</style>
<div data-content-type="html" data-appearance="default" data-element="main">&lt;p&gt;CMS homepage content goes
    here.&lt;/p&gt;
</div>
<div data-content-type="row" data-appearance="contained" data-element="main">
    <div data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image"
        data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true"
        data-video-fallback-src="" data-element="inner" data-pb-style="O4GRI2C">
        <div data-content-type="products" data-appearance="carousel" data-autoplay="false" data-autoplay-speed="4000"
            data-infinite-loop="false" data-show-arrows="false" data-show-dots="true" data-carousel-mode="default"
            data-center-padding="90px" data-element="main">{{widget
            type="Magento\CatalogWidget\Block\Product\ProductsList"
            template="Magento_PageBuilder::catalog/product/widget/content/carousel.phtml" anchor_text="" id_path=""
            show_pager="0" products_count="20" condition_option="condition" condition_option_value="" type_name="Catalog
            Products Carousel" conditions_encoded="^[`1`:^[`type`:``,`aggregator`:`all`,`value`:`1`,`new_child`:``^]^]"
            sort_order="date_newest_top"}}</div>
    </div>
</div>
HTML;

       $homePage->setContent($htmlContent);
       $this->pageRepository->save($homePage);
    }


    /**
     * Get aliases
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Get dependencies
     */
    public static function getDependencies()
    {
        return [];
    }
}
