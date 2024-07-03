# LaunchDarkly Sample OpenFeature PHP Server application

[![Build and run](https://github.com/launchdarkly/hello-openfeature-php-server/actions/workflows/ci.yml/badge.svg)](https://github.com/launchdarkly/hello-openfeature-php-server/actions/workflows/ci.yml)

We've built a simple console script that demonstrates how LaunchDarkly's OpenFeature provider works.

## Build instructions

1. Set the environment variable `LAUNCHDARKLY_SDK_KEY` to your LaunchDarkly SDK key. If there is an existing boolean feature flag in your LaunchDarkly project that you want to evaluate, set `LAUNCHDARKLY_FLAG_KEY` to the flag key; otherwise, a boolean flag of `sample-feature` will be assumed.

    ```bash
    export LAUNCHDARKLY_SDK_KEY="1234567890abcdef"
    export LAUNCHDARKLY_FLAG_KEY="my-boolean-flag"
    ```

1. On the command line, install the dependencies with `composer install`.
1. On the command line, run `php main.php`

You should receive the message "The <flagKey> feature flag evaluates to <flagValue>.". The application will run continuously and react to the flag changes in LaunchDarkly.
