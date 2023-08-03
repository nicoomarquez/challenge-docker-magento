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

class CreateProducts implements DataPatchInterface
{
    public function __construct(
        private Product $productModel,
        private StoreManagerInterface $storeManager,
        private ProductFactory $productFactory,
        private AppState $state
    ) {}

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->createProduct();
    }


    private function createProduct()
    {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        $attributeSetId = $this->productModel->getDefaultAttributeSetId();
        $productsToCreate = [
            'monitor_samsung_27' => 'Monitor Samsung 27',
            'nvidia_rtx_3090' => 'Nvidia Rtx 3090',
        ];

        foreach ($productsToCreate as $sku => $name) {
            $product = $this->productFactory->create();
            $product->setStoreId(Store::DEFAULT_STORE_ID);
            $product->setWebsiteIds([$this->storeManager->getDefaultStoreView()->getWebsiteId()]);
            $product->setTypeId('simple');
            $product->addData(array(
                'name' => $name,//name of product
                'attribute_set_id' => $attributeSetId,
                'status' => Status::STATUS_ENABLED,
                'visibility' => Visibility::VISIBILITY_BOTH,
                'weight' => 1,
                'sku' => $sku,//SKU of product
                'tax_class_id' => 0,
                'description' => $sku,
                'short_description' => $sku,
                'price' => 500,
                'stock_data' => array( //stock management
                    'manage_stock' => 1,
                    'qty' => 999,
                    'is_in_stock' => 1
                )
            ));
            $product->save();
        }
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
