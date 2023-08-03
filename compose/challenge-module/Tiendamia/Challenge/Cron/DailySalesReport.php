<?php

namespace Tiendamia\Challenge\Cron;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use Tiendamia\Challenge\Model\SalesReportRepository;

class DailySalesReport
{
    /**
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SalesReportRepository $salesReportRepository
     */
    public function __construct(
        private OrderItemRepositoryInterface $orderItemRepository,
        private SearchCriteriaBuilder        $searchCriteriaBuilder,
        private SalesReportRepository        $salesReportRepository
    ) {
    }

    /**
     * Executes Cron Report
     *
     * @param bool $useCurrentDay
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute($useCurrentDay = false)
    {
        $currentDate = date("Y-m-d");
        if ($useCurrentDay) {
            $previousDay = $currentDate;
        } else {
            $previousDay = date("Y-m-d", strtotime($currentDate . ' - 1 days'));
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('created_at', $previousDay . ' 00:00:00', 'gt')
            ->create();
        $orderItems = $this->orderItemRepository->getList($searchCriteria)->getItems();
        $dailySalesData = [];
        foreach ($orderItems as $item) {
            $currentItem = $item->getSku();
            $currentItemQty = $item->getQtyOrdered();

            $totalQty = $currentItemQty;

            if (array_key_exists($currentItem, $dailySalesData)) {
                $totalQty = $dailySalesData[$currentItem]['count'] + $currentItemQty;
            }

            $dailySalesData[$currentItem] = [
                'sku' => $currentItem,
                'count' => $totalQty,
                'date' => $previousDay
            ];
        }

        if (count($dailySalesData) > 0) {
            foreach ($dailySalesData as $sale) {
                $salesReport = $this->salesReportRepository->getEmptyModel();
                $salesReport->setData($sale);
                $this->salesReportRepository->save($salesReport);
            }
        }
    }
}
