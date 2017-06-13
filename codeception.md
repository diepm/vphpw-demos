### Work with [*Codeception*](http://codeception.com/).

---

Let's take this Cest class as an example.

```php
<?php
class HelloCest
{
    public function doSome(UnitTester $t)
    {
        $t->assertTrue(true);
    }

    public function testSome(UnitTester $t)
    {
        $t->assertFalse(false);
    }
}
```

First thing to do is to let `vphpw` know the test framework.

```
let g:vphpw_test_framework = 'codeception'
```

When the test framework is set to `codeception`, the default
test command is `codecept run`. If `codecept` is not in the
environment path, it can be specified as

```
let g:vphpw_test_cmd = './vendor/bin/codecept run'
```

Working with Cest now should be similar to phpunit. Assuming
the default key mapping is enabled, let's try running the test
class with some manually specified options.

* In `NORMAL` mode, `<Leader>to` (*test with options*).
* Enter `--steps -o 'settings: shuffle: true'` at the prompt
  and confirm; the Cest class is executed.
* Hit `<Leader>rl` (*run last*) to run the test again.
