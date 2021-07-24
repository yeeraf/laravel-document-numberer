<?php
namespace Yeeraf\DocumentNumberer\src\Facades;

use Illuminate\Support\Facades\Facade;

class DocumentNumbererFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'generate';
    }
}
