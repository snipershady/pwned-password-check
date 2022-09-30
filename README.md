# pwned-password-check
Easy to use PHP Implementation of the free API haveibeenpwned.com

```bash
composer require snipershady/pwned-password-check
```

## Context
You want to check if a password was already been pwned (same password has been hacked from another website) and then if it is safe to be used.
This check could be used as a service during a registration form, for example, maybe with an async call, as you prefer.

```php
use PwnedPassCheck\Service\PwnedPasswordCheckerService;

class fooClass(){
    public function checkIfPasswordHasBeenPowned(): string {
          $pownedPassChecker = new PwnedPasswordCheckerService();
          if(pownedPassChecker->hasPowned($password)){
            return json_encode(["powned" => true, "msg"=> "Your password has been powned and is unsafe"]);
          }
          return return json_encode(["powned" => false, "msg"=> "Your password was not been powned"]);
    }
}

```