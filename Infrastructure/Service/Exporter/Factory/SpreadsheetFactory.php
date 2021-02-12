<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Exporter\Factory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadsheetFactory implements SpreadsheetFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function getXlsxWriter(Spreadsheet $spreadsheet)
    {
        return new Xlsx($spreadsheet);
    }

    /**
     * @inheritDoc
     */
    public function getSpreadsheet($worksheetCount)
    {
        $spreadsheet = new Spreadsheet();
        for ($offset = 1; $offset < $worksheetCount; $offset++) {
            $spreadsheet->createSheet($offset);
        }

        return $spreadsheet;
    }

    /**
     * @inheritDoc
     */
    public function setAutosizeAllColumns(Spreadsheet $spreadsheet)
    {
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $spreadsheet->setActiveSheetIndex($spreadsheet->getIndex($worksheet));

            $current = $spreadsheet->getActiveSheet();
            $cellIterator = $current->getRowIterator()->current()->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);

            foreach ($cellIterator as $cell) {
                $current->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getNumberFormat()
    {
        return NumberFormat::FORMAT_NUMBER;
    }
}
