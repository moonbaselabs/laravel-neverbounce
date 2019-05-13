# laravel-neverbounce

A laravel wrapper for the [NeverBounceAPI-PHP](https://github.com/NeverBounce/NeverBounceAPI-PHP).

Extends Laravel Validator to check a single email address against the NeverBounce API.

The Neverbounce API allows up to [1,000 free email verifications](https://neverbounce.com/help/getting-started/how-do-the-1000-free-credits-work) per month.

---

## Installation

Within your Terminal:

```bash
composer require moonbaselabs/laravel-neverbounce
```

Add configuration values to `configs/services.php`:

```php
    'neverbounce' => [
        'api_key' => env('NEVERBOUNCE_API_KEY'),
    ],
```

**Obtain Neverbounce API Key:**

1. [Register]("https://app.neverbounce.com/register") for a Neverbounce Account.
2. Create a new App.
3. Copy secret API Key. (Note: Make sure it is a v4 api key. It will start with `private_***`).

Add Neverbounce API Key to `.env`:

```php
NEVERBOUNCE_API_KEY=private_key
```

Add translation to `resources/lang/en/validation.php`

```php
    'neverbounce' => 'The :attribute is not valid. :suggestion :error',
```

---

## Useage

```php
    $emailInput = $request->validate([
        'email' => 'required|email|neverbounce',
    ]);
```
