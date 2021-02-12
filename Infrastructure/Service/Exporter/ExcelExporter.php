<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Exporter;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\OrderIssue;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Exporter\Factory\SpreadsheetFactoryInterface;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage\Factory\FileHandlerFactoryInterface;

class ExcelExporter implements ExporterInterface
{
    /** @var DateTimeFactoryInterface */
    private $dateTimeFactory;

    /** @var SpreadsheetFactoryInterface */
    private $spreadsheetFactory;

    /** @var FileHandlerFactoryInterface */
    private $fileHandlerFactory;

    /** @var string[] */
    private $sections = [
        'last_day' => 'За прошлые сутки',
        'other'    => 'За все время',
    ];

    public function __construct(
        DateTimeFactoryInterface $dateTimeFactory,
        SpreadsheetFactoryInterface $spreadsheetFactory,
        FileHandlerFactoryInterface $fileHandlerFactory
    ) {
        $this->dateTimeFactory = $dateTimeFactory;
        $this->spreadsheetFactory = $spreadsheetFactory;
        $this->fileHandlerFactory = $fileHandlerFactory;
    }

    /**
     * @inheritDoc
     */
    public function export(array $splitedIssues)
    {
        $tmpHandler = $this->fileHandlerFactory->getTemporaryFileHandler();
        $spreadsheet = $this->spreadsheetFactory->getSpreadsheet(count($this->sections));

        $offsetSheet = 0;
        foreach ($splitedIssues as $period => $orderIssues) {
            $spreadsheet->setActiveSheetIndex($offsetSheet);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet
                ->setTitle($this->sections[$period])
                ->setCellValue('A1', '№ заказа Aliexpress')
                ->setCellValue('B1', '№ заказа Технопарк')
                ->setCellValue('C1', 'Текущая проблема')
                ->setCellValue('D1', 'Дата и время отправки письма')
                ->setCellValue('E1', 'Дата и время планируемого решения')
                ->setCellValue('F1', 'Плановое время решения проблемы (в часах)');

            $offsetCell = 2;
            /** @var OrderIssue $orderIssue */
            foreach ($orderIssues as $orderIssue) {
                $worksheet
                    ->setCellValue("A{$offsetCell}", $orderIssue->externalOrderId)
                    ->setCellValue("B{$offsetCell}", $orderIssue->publicOrderId)
                    ->setCellValue("C{$offsetCell}", $orderIssue->issue)
                    ->setCellValue("D{$offsetCell}", $orderIssue->dateTimeCreated->format(
                        $this->dateTimeFactory->getYmdHisFormat())
                    )
                    ->setCellValue("E{$offsetCell}", $orderIssue->dateTimeResolvedPlanned->format(
                        $this->dateTimeFactory->getYmdHisFormat())
                    )
                    ->setCellValue("F{$offsetCell}", $orderIssue->allottedTimeForResolveInHours);

                $worksheet
                    ->getStyle("A{$offsetCell}")
                    ->getNumberFormat()
                    ->setFormatCode($this->spreadsheetFactory->getNumberFormat());

                $offsetCell++;
            }

            $offsetSheet++;
        }

        $this->spreadsheetFactory->setAutosizeAllColumns($spreadsheet);
        $spreadsheet->setActiveSheetIndex(0);

        $writer = $this->spreadsheetFactory->getXlsxWriter($spreadsheet);
        $writer->save($tmpHandler->getFilePath());

        return $tmpHandler;
    }
}
