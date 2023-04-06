# LaunchDarkly Sample OpenFeature PHP Server application

We've built a simple console script that demonstrates how LaunchDarkly's OpenFeature provider works.

## Build instructions

1. Install the project dependencies by running `composer install`

2. Edit `index.php` and set the value of `$sdkKey` to your LaunchDarkly SDK key. If there is an existing boolean feature flag in your LaunchDarkly project that you want to evaluate, set `$featureFlagKey` to the flag key.

```php
$sdkKey = "1234567890abcdef";

$featureFlagKey = "my-flag";
```

3. Run `php index.php`.

You should see the message `"Feature flag '<flag key>' is <true/false> for this context"`.
