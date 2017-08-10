@echo off

rem -------------------------------------------------------------
rem  Yii command line init script for Windows.
rem
rem  @author Qiang Xue <qiang.xue@gmail.com>
rem  @link http://www.yiiframework.com/
rem  @copyright Copyright (c) 2008 Yii Software LLC
rem  @license http://www.yiiframework.com/license/
rem -------------------------------------------------------------

@setlocal

set _PATH=%~dp0

cd "%_PATH%..\tests"

"%_PATH%..\.tools\Codeception\codecept.bat" run
"%PHP_COMMAND%" "%_PATH%..\yii" migrate/up

@endlocal
