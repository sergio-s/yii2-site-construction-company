<?php
namespace common\repositories\settings;


interface ISettingsRepository{
    
    public function getAllSettings();

    public function getSettingsById($id);
}

