# pwned-password-check
Easy to use PHP Implementation of the free API haveibeenpwned.com

```bash
composer require snipershady/pwnedpasscheck
```

## Context
You want to check if a password was already been pwned (same password has been hacked from another website) and then if it is safe to be used.
This check could be used as a service during a registration form, for example, maybe with an async call, as you prefer.

```php
use PwnedPassCheck\Service\PwnedPasswordCheckerService;

class fooClass(){
    public function checkIfPasswordHasBeenPowned(): bool {
          $pownedPassChecker = new PwnedPasswordCheckerService();
          return pownedPassChecker->hasPowned($password);
    }
}

```