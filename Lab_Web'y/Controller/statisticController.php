<?php
if (file_exists('./View/statisticView.php')) {
    require_once('./View/statisticView.php');
}
if (file_exists('./Model/statystykiModel.php')) {
    require_once('./Model/statystykiModel.php');
}

class Controller extends Model
{
    public $model;
    public $view;

    function __construct($fileName)
    {
        $this->model = new Model();
        $this->view = new View();
        $this->fileName = $fileName;
    }
}

$kontroler = new Controller("db/daneStatystyczne.txt");
if ($kontroler->checkFilename()) {
    $kontroler->getRecord();
    $kontroler->view->setViewData($kontroler->getContent());
    $kontroler->view->formatData();
    $kontroler->view->showTable();
    $kontroler->view->showCharts();
} else {
    $kontroler->view->showError("Nie ustawiono nazwy pliku");
}
