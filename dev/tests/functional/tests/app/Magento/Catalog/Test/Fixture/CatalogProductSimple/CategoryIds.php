<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Catalog\Test\Fixture\CatalogProductSimple;

use Magento\Catalog\Test\Fixture\CatalogCategoryEntity;
use Mtf\Fixture\FixtureFactory;
use Mtf\Fixture\FixtureInterface;

/**
 * Class CategoryIds
 * Create and return Category
 */
class CategoryIds implements FixtureInterface
{
    /**
     * Names and Ids of the created categories
     *
     * @var array
     */
    protected $data;

    /**
     * New categories
     *
     * @var array
     */
    protected $category;

    /**
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array $data
     */
    public function __construct(
        FixtureFactory $fixtureFactory,
        array $params,
        array $data = []
    ) {
        $this->params = $params;
        if (isset($data['presets']) && $data['presets'] !== '-') {
            $presets = explode(',', $data['presets']);
            foreach ($presets as $preset) {
                $category = $fixtureFactory->createByCode('catalogCategoryEntity', ['dataSet' => $preset]);
                $category->persist();

                /** @var CatalogCategoryEntity $category */
                $this->data = [
                    [
                        'id' => $category->getId(),
                        'name' => $category->getName(),
                    ],
                ];
                $this->category[] = $category;
            }
        }
    }

    /**
     * Persist custom selections products
     *
     * @return void
     */
    public function persist()
    {
        //
    }

    /**
     * Return prepared data set
     *
     * @param $key [optional]
     * @return mixed
     */
    public function getData($key = null)
    {
        return $this->data;
    }

    /**
     * Return data set configuration settings
     *
     * @return array
     */
    public function getDataConfig()
    {
        return $this->params;
    }

    /**
     * Return category array
     *
     * @return array
     */
    public function getCategory()
    {
        return $this->category;
    }
}
