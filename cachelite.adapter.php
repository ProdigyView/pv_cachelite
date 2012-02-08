<?php
/**
 * The adapter will replace the functionality the PVCache methods and adapt them to use the 
 * methods in the CacheLite class. In other words, CacheLite becomes similiar to a dependent
 * of the cache class.
 * 
 * The adapter is an example of aspect oriented programming.
 */

PVCache::addAdapter('PVCache', 'init', 'CacheLite');
 
PVCache::addAdapter('PVCache', 'writeCache', 'CacheLite');

PVCache::addAdapter('PVCache', 'readCache', 'CacheLite');

PVCache::addAdapter('PVCache', 'hasExpired', 'CacheLite');

PVCache::addAdapter('PVCache', 'getExpiration', 'CacheLite');

PVCache::addAdapter('PVCache', 'deleteCache', 'CacheLite');