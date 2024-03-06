# LaunchDarkly Sample OpenFeature PHP Server application

[![Build and run](https://github.com/launchdarkly/hello-openfeature-php-server/actions/workflows/ci.yml/badge.svg)](https://github.com/launchdarkly/hello-openfeature-php-server/actions/workflows/ci.yml)

We've built a simple console script that demonstrates how LaunchDarkly's OpenFeature provider works.

## Build instructions

1. Install the project dependencies by running `composer install`
1. On the command line, set the value of the environment variable `LAUNCHDARKLY_SERVER_KEY` to your LaunchDarkly SDK key.
    ```bash
    export LAUNCHDARKLY_SERVER_KEY="1234567890abcdef"
    ```
1. On the command line, set the value of the environment variable `LAUNCHDARKLY_FLAG_KEY` to an existing boolean feature flag in your LaunchDarkly project that you want to evaluate.

    ```bash
    export LAUNCHDARKLY_FLAG_KEY="my-boolean-flag"
    ```
1. Run `php index.php`.

You should see the message `"Feature flag '<flag key>' is <true/false> for this context"`.
