<?php

use OpenFeature\OpenFeatureAPI;
use OpenFeature\implementation\flags\Attributes;
use OpenFeature\implementation\flags\EvaluationContext;

require 'vendor/autoload.php';

# Set $sdkKey to your LaunchDarkly SDK key before running
$sdkKey = getenv("LAUNCHDARKLY_SERVER_KEY");

# Set $featureFlagFey to the feature flag key you want to evaluate
$featureFlagKey = getenv("LAUNCHDARKLY_FLAG_KEY");

if (!$sdkKey) {
  echo "*** Please set LAUNCHDARKLY_SERVER_KEY env first\n\n";
  exit(1);
} else if (!$featureFlagKey) {
  echo "*** Please set LAUNCHDARKLY_FLAG_KEY env first\n\n";
  exit(1);
}

$ldClient = new LaunchDarkly\LDClient($sdkKey);
$provider = new LaunchDarkly\OpenFeature\Provider($ldClient);

$api = OpenFeatureAPI::getInstance();
$api->setProvider($provider);

$client = $api->getClient("hello-client", 1);

# Set up the evaluation context. This context should appear on your LaunchDarkly
# contexts dashboard soon after you run the demo.
$attributes = new Attributes(["name" => "Sandy"]);
$context = new EvaluationContext("example-user-key", $attributes);

$flagValue = $client->getBooleanValue($featureFlagKey, false, $context);
$flagValueStr = $flagValue ? 'true' : 'false';

echo "*** Feature flag '{$featureFlagKey}' is {$flagValueStr} for this context\n\n";
