<?php

use OpenFeature\OpenFeatureAPI;
use OpenFeature\implementation\flags\Attributes;
use OpenFeature\implementation\flags\EvaluationContext;

require 'vendor/autoload.php';

function showEvaluationResult(string $key, bool $value) {
    echo PHP_EOL;
    echo sprintf("*** The %s feature flag evaluates to %s", $key, $value ? 'true' : 'false');
    echo PHP_EOL;

    if ($value) {
        showBanner();
    }
}

function showBanner() {
    echo PHP_EOL;
    echo "        ██       " . PHP_EOL;
    echo "          ██     " . PHP_EOL;
    echo "      ████████   " . PHP_EOL;
    echo "         ███████ " . PHP_EOL;
    echo "██ LAUNCHDARKLY █" . PHP_EOL;
    echo "         ███████ " . PHP_EOL;
    echo "      ████████   " . PHP_EOL;
    echo "          ██     " . PHP_EOL;
    echo "        ██       " . PHP_EOL;
    echo PHP_EOL;
}

// Set $sdkKey to your LaunchDarkly SDK key.
$sdkKey = getenv("LAUNCHDARKLY_SDK_KEY") ?? "";

// Set $featureFlagKey to the feature flag key you want to evaluate.
$featureFlagKey = getenv("LAUNCHDARKLY_FLAG_KEY");
if (!$featureFlagKey) {
    $featureFlagKey = 'sample-feature';
}

$ci = getenv("CI") ?? false;

if (!$sdkKey) {
  echo "*** Please set the environment variable LAUNCHDARKLY_SDK_KEY to your LaunchDarkly SDK key first" . PHP_EOL . PHP_EOL;
  exit(1);
} else if (!$featureFlagKey) {
  echo "*** Please set the environment variable LAUNCHDARKLY_FLAG_KEY to a boolean flag first" . PHP_EOL . PHP_EOL;
  exit(1);
}

$provider = new LaunchDarkly\OpenFeature\Provider($sdkKey);
$api = OpenFeatureAPI::getInstance();
$api->setProvider($provider);

$client = $api->getClient("hello-client", 1);

// Set up the evaluation context. This context should appear on your LaunchDarkly contexts dashboard soon after you run the demo.
# Set up the evaluation context. This context should appear on your LaunchDarkly
# contexts dashboard soon after you run the demo.
$attributes = new Attributes(["name" => "Sandy", "kind" => "user"]);
$context = new EvaluationContext("example-user-key", $attributes);

$lastValue = null;
do {
    $flagValue = $client->getBooleanValue($featureFlagKey, false, $context);

    if ($flagValue !== $lastValue) {
        showEvaluationResult($featureFlagKey, $flagValue);
        $lastValue = $flagValue;
    }

    sleep(1);
} while(!$ci);
