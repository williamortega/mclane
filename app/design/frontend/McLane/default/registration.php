<?php
/**
 * Register "McLane/default" module.
 */

use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
  ComponentRegistrar::THEME,
  'frontend/McLane/default',
  __DIR__
);
