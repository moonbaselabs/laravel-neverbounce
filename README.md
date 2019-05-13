# laravel-neverbounce

Validate an email address against the [NeverBounce API](https://neverbounce.com).

## Installation

```bash
composer require moonbaselabs/laravel-neverbounce
```

Add API key to `configs/services.php` (See [Obtaining an API Key](#obtaining-an-api-key) below):

```php
'neverbounce' => [
    'api_key' => env('NEVERBOUNCE_API_KEY'),
],
```

Add translation to `resources/lang/en/validation.php`

```php
'neverbounce' => 'The :attribute is not valid. :suggestion :error',
```

### Obtaining an API key

1. [Register]("https://app.neverbounce.com/register") for a Neverbounce Account.
2. Create a new App.
3. Copy secret API Key. (Note: Make sure it is a v4 api key. It will start with `private_***`).

## Usage

```php
    $emailInput = $request->validate([
        'email' => 'required|email|neverbounce',
    ]);
```
