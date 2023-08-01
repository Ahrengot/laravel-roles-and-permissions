<?php

use Ahrengot\RolesAndPermissions\Contracts\Describable;
use Ahrengot\RolesAndPermissions\Contracts\StaticArrayable;
use Ahrengot\RolesAndPermissions\Traits\IsStaticArrayable;

it('converts enums to associative arrays', function () {
    enum ArrayableEnumTester: string implements Describable, StaticArrayable
    {
        use IsStaticArrayable;

        case Foo = 'foo';
        case Bar = 'bar';

        public function description(): string
        {
            return match ($this) {
                self::Foo => 'Foo',
                self::Bar => 'Bar',
            };
        }
    }

    expect(ArrayableEnumTester::asArray())->toBe([
        'foo' => 'Foo',
        'bar' => 'Bar',
    ]);
});
