<?php

namespace CharlGottschalk\FeatureToggle;

use CharlGottschalk\FeatureToggle\Transformers\Transformer;

class FeatureManager
{
    public static function index($take, $page)
    {
        $results = config('features.driver')::index($take, $page);
        return Transformer::transformResults($results);
    }

    public static function show($id)
    {
        $feature = config('features.driver')::show($id);
        return Transformer::transformFeature($feature);
    }

    public static function store($name, $enabled)
    {
        $feature = config('features.driver')::store($name, $enabled);
        return Transformer::transformFeature($feature);
    }

    public static function update($id, $roleIds)
    {
        $feature = config('features.driver')::update($id, $roleIds);
        return Transformer::transformFeature($feature);
    }

    public static function delete($id)
    {
        return config('features.driver')::delete($id);
    }

    public static function enable($id)
    {
        $feature = config('features.driver')::enable($id);
        return Transformer::transformFeature($feature);
    }

    public static function disable($id)
    {
        $feature = config('features.driver')::disable($id);
        return Transformer::transformFeature($feature);
    }

    public static function toggle($id)
    {
        $feature = config('features.driver')::toggle($id);
        return Transformer::transformFeature($feature);
    }

    public static function showByName($name)
    {
        $feature = config('features.driver')::showByName($name);
        return Transformer::transformFeature($feature);
    }

    public static function deleteByName($name)
    {
        return config('features.driver')::deleteByName($name);
    }

    public static function enableByName($name)
    {
        $feature = config('features.driver')::enableByName($name);
        return Transformer::transformFeature($feature);
    }

    public static function disableByName($name)
    {
        $feature = config('features.driver')::disableByName($name);
        return Transformer::transformFeature($feature);
    }

    public static function toggleByName($name)
    {
        $feature = config('features.driver')::toggleByName($name);
        return Transformer::transformFeature($feature);
    }

    public static function attachRole($featureId, $roleId)
    {
        $feature = config('features.driver')::attachRole($featureId, $roleId);
        return Transformer::transformFeature($feature);
    }

    public static function attachRoleByName($featureName, $roleId)
    {
        $feature = config('features.driver')::attachRoleByName($featureName, $roleId);
        return Transformer::transformFeature($feature);
    }

    public static function detachRole($featureId, $roleId)
    {
        $feature = config('features.driver')::detachRole($featureId, $roleId);
        return Transformer::transformFeature($feature);
    }

    public static function detachRoleByName($featureName, $roleId)
    {
        $feature = config('features.driver')::detachRoleByName($featureName, $roleId);
        return Transformer::transformFeature($feature);
    }

    public static function syncRoles($featureId, $roleIds)
    {
        $feature = config('features.driver')::syncRoles($featureId, $roleIds);
        return Transformer::transformFeature($feature);
    }

    public static function syncRolesByName($featureName, $roleIds)
    {
        $feature = config('features.driver')::syncRolesByName($featureName, $roleIds);
        return Transformer::transformFeature($feature);
    }
}