<?php

declare(strict_types = 1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;

use Rector\Php73\Rector\BooleanOr\IsCountableRector;
use Rector\Php73\Rector\FuncCall\ArrayKeyFirstLastRector;
use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;
use Rector\Php73\Rector\FuncCall\RegexDashEscapeRector;
use Rector\Php73\Rector\FuncCall\SetCookieRector;
use Rector\Php73\Rector\FuncCall\StringifyStrNeedlesRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;

use Rector\Php74\Rector\Assign\NullCoalescingOperatorRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php74\Rector\FuncCall\ArraySpreadInsteadOfArrayMergeRector;
use Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector;
use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;
use Rector\Php74\Rector\Property\TypedPropertyRector;

use Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php80\Rector\Class_\StringableForToStringRector;
use Rector\Php80\Rector\FuncCall\ClassOnObjectRector;
use Rector\Php80\Rector\FuncCall\TokenGetAllToObjectRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Php80\Rector\Identical\StrEndsWithRector;
use Rector\Php80\Rector\Identical\StrStartsWithRector;
use Rector\Php80\Rector\NotIdentical\StrContainsRector;
use Rector\Php80\Rector\Switch_\ChangeSwitchToMatchRector;
use Rector\Php80\Rector\Ternary\GetDebugTypeRector;
use Rector\Php70\Rector\ClassMethod\Php4ConstructorRector;
use Rector\Php72\Rector\FuncCall\CreateFunctionToAnonymousFunctionRector;
use Rector\Php72\Rector\Assign\ListEachRector;
use Rector\Php72\Rector\While_\WhileEachToForeachRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Transform\Rector\StaticCall\StaticCallToFuncCallRector;

use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/spec',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // define sets of rules
    $rectorConfig->sets([
        SetList::PHP_80,
        SetList::PHP_74,
        SetList::PHP_73,
    ]);

    // Deprecated in PHP 7.4
    $rectorConfig->rule(ConsistentImplodeRector::class);

    // Deprecated in PHP 7.2 - Incompatible in PHP 8.0
    $rectorConfig->rule(Php4ConstructorRector::class);
    $rectorConfig->rule(CreateFunctionToAnonymousFunctionRector::class);
    $rectorConfig->rule(ListEachRector::class);
    $rectorConfig->rule(WhileEachToForeachRector::class);

    // Specify PHP version if you want to check for a version different from the one specified in composer.json
    $rectorConfig->phpVersion(PhpVersion::PHP_80);

    // define rules to skip
    $rectorConfig->skip([

        // PHP 8.0 rules
        ChangeSwitchToMatchRector::class,
        ClassOnObjectRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        GetDebugTypeRector::class,
        MixedTypeRector::class,
        RemoveUnusedVariableInCatchRector::class,
        StrContainsRector::class,
        StrStartsWithRector::class,
        StrEndsWithRector::class,
        StringableForToStringRector::class,
        TokenGetAllToObjectRector::class,
        UnionTypesRector::class,
        // configurable rules   vvv
        StaticCallToFuncCallRector::class,
        ArgumentAdderRector::class,
        RenameFunctionRector::class,

        // PHP 7.4 rules
        AddLiteralSeparatorToNumberRector::class,
        ArraySpreadInsteadOfArrayMergeRector::class,
        ClosureToArrowFunctionRector::class,
        NullCoalescingOperatorRector::class,
        RestoreDefaultNullToNullableTypePropertyRector::class,
        TypedPropertyRector::class,

        // PHP 7.3 rules
        ArrayKeyFirstLastRector::class,
        IsCountableRector::class,
        JsonThrowOnErrorRector::class,
        RegexDashEscapeRector::class,
        SetCookieRector::class,
        StringifyStrNeedlesRector::class,
    ]);
};

//    > vendor/bin/rector process --dry-run  --clear-cache
