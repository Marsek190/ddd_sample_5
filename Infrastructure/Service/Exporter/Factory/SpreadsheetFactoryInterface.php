<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Exporter\Factory;

use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

interface SpreadsheetFactoryInterface
{
    /**
     * @param Spreadsheet $spreadsheet
     * @return Xlsx
     */
    public function getXlsxWriter(Spreadsheet $spreadsheet);

    /**
     * @param int $worksheetCount
     * @return Spreadsheet
     * @throws Exception
     */
    public function getSpreadsheet($worksheetCount);

    /**
     * @param Spreadsheet $spreadsheet
     * @throws Exception
     * @return void
     */
    public function setAutosizeAllColumns(Spreadsheet $spreadsheet);

    /**
     * @return string
     */
    public function getNumberFormat();
}
