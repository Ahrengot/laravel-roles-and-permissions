<?php

use Ahrengot\RolesAndPermissions\Contracts\Comparable;
use Ahrengot\RolesAndPermissions\Traits\IsComparableEnum;

beforeAll(function () {
    enum ComparableEnumTester: string implements Comparable
    {
        use IsComparableEnum;

        case Foo = 'foo';
        case Bar = 'bar';
    }
});

it('matches using value', function () {
    expect(ComparableEnumTester::Foo->is(ComparableEnumTester::Foo->value))
        ->toBeTrue()
        ->and(ComparableEnumTester::Foo->isNot(ComparableEnumTester::Bar->value))
        ->toBeTrue();
});

it('matches using instance', function () {
    expect(ComparableEnumTester::Foo->is(ComparableEnumTester::Foo))
        ->toBeTrue()
        ->and(ComparableEnumTester::Foo->isNot(ComparableEnumTester::Bar))
        ->toBeTrue();
});
