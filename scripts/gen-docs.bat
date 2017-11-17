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

rmdir "%_PATH%..\docs" /S /Q
mkdir "%_PATH%..\docs"

"%PHP_COMMAND%" "%_PATH%..\.tools\ApiGen\apigen.phar" generate --config="%_PATH%apigen.yml"

@endlocal
