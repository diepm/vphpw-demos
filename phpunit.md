### Some sample functions for *PHPUnit*.

---

This function is to run a test class multiple times using the `--repeat` option.

```VimL
"""
" Run the current test class multiple times.
"
func! VphpwTestWithRepeatOption()
  let nr = str2nr(input('--repeat '))
  if !nr
    return
  endif
  call vphpw#cmd#Execute('vphpw#cmd#BuildTestCommand', {
    \ 'params': ['--repeat', nr],
    \ 'target': expand('%'),
  \})
endfunc
```

This one is to run a test suite using the `--testsuite` option.

```VimL
"""
" Run a test suite.
"
func! VphpwRunTestSuite()
  let suite = input('--testsuite ')
  if empty(suite)
    return
  endif
  call vphpw#cmd#Execute('vphpw#cmd#BuildTestCommand', {
    \ 'params': ['--testsuite', suite],
    \ 'asLast': 1
  \})
endfunc
```
