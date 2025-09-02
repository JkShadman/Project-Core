<?php

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use App\Console\Kernel as ConsoleKernel;
use App\Http\Kernel as HttpKernel;
use App\Exceptions\Handler;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    HttpKernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Handler::class
);

return $app;