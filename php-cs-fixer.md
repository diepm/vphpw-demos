### Writing custom functions for [*php-cs-fixer*](https://github.com/FriendsOfPHP/PHP-CS-Fixer).

---

Say, we want to run `php-cs-fixer` on the current PHP buffer to check against
some standards. Let's start with a Vim function to run the fixer command given a
list of options.

```VimL
"""
" Run php-cs-fixer on the current buffer with the given options.
"
" @param list a:fixerOpts
"
func! VphpwRunPhpCsFixer(fixerOpts)
  if empty(a:fixerOpts)
    echo 'No options to run fixer.'
    return
  endif

  let cmd = vphpw#util#GetOpt('vphpw_php_cs_fixer_cmd', 'php-cs-fixer fix') . ' '
        \ . join(vphpw#cmd#ShellEscapeOpts(a:fixerOpts), ' ')

  call vphpw#cmd#RunCommand(cmd, {
    \ 'target': expand('%'),
    \ 'asLast': 1,
  \})
endfunc
```

This function implicitly defines a new option specifying the fixer command,
`vphpw_php_cs_fixer_cmd`. If this option is not set, `php-cs-fixer fix` is the
default fixer command. It then runs the command built with the given options on
the target (current buffer) and keeps this command as the last command to repeat
later.

Now we have a handy wrapper function for `php-cs-fixer`. Let's write another Vim
function to check for some specific standards.

```VimL
"""
" Check for PSR-2 and unused imports.
"
func! VphpwCheckStandards()
  call VphpwRunPhpCsFixer([
    \ '--dry-run', '--diff',
    \ '--using-cache=no',
    \ '--rules=@PSR2,no_unused_imports'
  \])
endfunc
```

We can then call this function by `:call VphpwCheckStandards()`. We can also map
`VphpwRunPhpCsFixer()` directly to some keys with specific options such as

```
noremap <some-keys> :call VphpwRunPhpCsFixer(['--dry-run', '--diff', '--rules=@PSR2'])<CR>
```

There will be an error if `php-cs-fixer` is not in the environment path. It's
where the new option, `vphpw_php_cs_fixer_cmd`, comes in handy.

```
let g:vphpw_php_cs_fixer = './vendor/bin/php-cs-fixer fix'
```

Have fun Vimming ;-)
