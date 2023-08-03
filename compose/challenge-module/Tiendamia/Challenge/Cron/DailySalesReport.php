<?php

namespace Tiendamia\Challenge\Cron;

use Magento\Sales\Api\OrderItemRepositoryInterface;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use Tiendamia\Challenge\Model\SalesReportRepository;

class DailySalesReport
{
    public function __construct(
        private OrderItemRepositoryInterface $orderItemRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private SalesReportRepository $salesReportRepository
    ) {}

    public function execute() {
        $currentDate = date("Y-m-d");
        $previousDay = $currentDate; //date("Y-m-d", strtotime($currentDate . ' - 1 days'));

        $searchCriteria = $this->searchCriteriaBuilder->addFilter('created_at', $previousDay.' 00:00:00', 'gt')->create();
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
