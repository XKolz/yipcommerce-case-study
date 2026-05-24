<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Smarty\Smarty;

class SmartyRenderer
{
    public function render(string $template, array $data = []): string
    {
        File::ensureDirectoryExists(storage_path('framework/smarty/templates_c'));
        File::ensureDirectoryExists(storage_path('framework/smarty/cache'));

        $smarty = new Smarty;
        $smarty->setTemplateDir(resource_path('smarty'));
        $smarty->setCompileDir(storage_path('framework/smarty/templates_c'));
        $smarty->setCacheDir(storage_path('framework/smarty/cache'));

        foreach ($data as $key => $value) {
            $smarty->assign($key, $value);
        }

        return $smarty->fetch($template);
    }
}
