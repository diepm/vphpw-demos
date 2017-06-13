### Sample project to demonstrate [*Vim PHP Wrapper* (*vphpw*)](https://github.com/diepm/vim-php-wrapper).

---

Let's walk through the development process of this toy project to see **vphpw**
in action. Assuming we follow **TDD** (test-driven development), the steps would
include

  * Write a test case for a method (unimplemented).
  * Run this test case; it should fail.
  * Implement the method.
  * Run the test case again; it should pass.
  * Document the method.

Requirements:

  * PHP >= 5.6.
  * [composer](https://getcomposer.org/).

Note: <code>&#9475;</code> indicates the cursor in  `INSERT` mode.

#### 1. Setup

* Make sure you're in the project root (`vphpw-demos/php-project/`).
* `composer install` to install [PHPUnit](https://phpunit.de/) (5.7).
* `vim setup.vim` to check some options enabled for the sake of this
  walk-through including the default key mapping.
* Within Vim, `:so %` to source this Vim setup.

#### 2. Write test case

* `:e src/Service/User.php` to check for the method to be implemented.
* Switch to the test class, `:e tests/Service/UserTest.php`, and start to write
  the test case for `addConnection()` method.
* Within `testAddConnection()` method body, type in
  <code>$user1 = new User&#9475;</code>.
* Still in `INSERT` mode, hit `<C-Space>ic` (*import class*) to import the
  `User` model class. Vim will prompt for class selection since the project has
  two classes with the same name, `User` *model* and `User` *service*.
* Select the `User` model class. Vim will import it to the file header.
* Continue to finish the statement as
  <code>$user1 = new User<b>(1);</b>&#9475;</code>.
* Initialize another user object, <code>$user2 = new User(2);&#9475;</code>.
* Initialize the `User` *service*, <code>$service = new User&#9475;</code>.
* Hit `<C-Space>ia` (*import as*) to import the `User` service with a different
  name since `User` is already taken.
* Vim will prompt for the class alias, ``Import `User` as: ``, let's use
  `UserService` as the alias.
* Vim will prompt for class selection again. Choose `User` service this time.
  This class will be imported with the alias `UserService`.
* Continue to finish this statement as
  <code>$service = new UserService<b>();</b>&#9475;</code>.
* Let's call the service's `addConnection()` and assert that it returns `true`.

  <pre><code>$this->assertTrue($service->addConnection(
      $user1,
      $user2,
      new Relationship&#9475;
  </code></pre>

* Hit `<C-Space>ii` (*import inline*) to do an inline import of the
  `Relationship` class.
* Continue to finish the assertion statement as

  <pre><code>$this->assertTrue($service->addConnection(
      $user1,
      $user2,
      new \Vphpw\Model\Relationship<b>('friend')
  ));</b>&#9475;
  </code></pre>

* Back to `NORMAL` mode and save this test class.

#### 3. Execute the test case

With the cursor within the test case body (line 18, for example), there are two
ways to execute the test class in `NORMAL` mode, `<Leader>ta` (*test all*) to
run all test cases of the test class and `<Leader>tk` (*test closest method
above cursor*) to run the closest test case above the cursor. In this scenario,
since the cursor is within the test case body, the test case is literally
"above" the cursor.

Let's try both (the test case should fail).

* Hit `<Leader>ta` to test all.
* Hit `<Leader>tk` to test `testAddConnection()`. This test case will be
  high-lighted indicating that it's the one being executed.
* To clear the highlight, `<Leader>cm` (*clear matches*).

#### 4. Implement method

Let's switch back to the `User` service class to implement the method.

* `:e src/Service/User.php`.
* Change the `TODO` line to <code>return true;&#9475;</code>.
* Back to `NORMAL` mode and save the file.
* Hit `<Leader>rl` (*run last*) to execute the test case of this method; the
  test should pass. We don't have to go back to the test class to run the test
  case since the last command we ran at the
  [previous step](#3-execute-the-test-case) was to execute the
  `testAddConnection()` test case, we can now "repeat" the command.

If you have [vim-dispatch](https://github.com/tpope/vim-dispatch) installed, you
can ask `vphpw` to let `vim-dispatch` handle the output.

* In `NORMAL` mode, `:let g:vphpw_use_dispatch = 1`.
* `<Leader>rl` to run the test command again.

#### 5. Document method

Now we're done with the method, let's document it.

* With the cursor within the method body (say, line 17), `<Leader>dk` (*document
  closest method above cursor*) to generate a docblock for this method.
* Let's correct the type of the `$rel` parameter
  to <code>@param Relationship<b>|null</b>&#9475; $rel</code>.
* To align the doblock, back to `NORMAL` mode and with the cursor within the
  docblock body (line 16, for example), hit `<Leader>dl` (*doc line up*).

With PHP7, we can specify the return type of the method. If you're on PHP7,
let's try this.

* Specify the return type of the method as `bool`.

  <pre><code>    ...
      Relationship $rel = null
  )<b>: bool</b>&#9475; {
      return true;
  }
  </code></pre>

* To re-generate the docblock, back to `NORMAL` mode and hit `<Leader>dk`.
* To delete the old docblock, move the cursor to that docblock body and hit
  `<Leader>dd` (*doc delete*).
