<?php

namespace CharlGottschalk\FeatureToggle\Drivers;

use CharlGottschalk\FeatureToggle\Traits\ApiTrait;
use CharlGottschalk\FeatureToggle\Transformers\Drivers\ApiTransformer;

class Api implements DriverInterface
{
    use ApiTrait;

    public static function index($take, $page)
    {
        return self::get('', ['take' => $take, 'page' => $page]);
    }

    public static function show($id)
    {
        return self::post('show', ['id' => $id]);
    }

    public static function showByName($name)
    {
        return self::post('show', ['name' => $name]);
    }

    public static function store($name, $enabled)
    {
        return self::post('store', [
            'name' => $name,
            'enabled' => $enabled
        ]);
    }

    public static function update($id, $roleIds)
    {
        return self::post($id . '/update', [
            'role_ids' => $roleIds
        ]);
    }

    public static function delete($id)
    {
        return self::post('delete', ['id' => $id]);
    }

    public static function deleteByName($name)
    {
        return self::post('delete', ['name' => $name]);
    }

    public static function enable($id)
    {
        return self::post('enable', ['id' => $id]);
    }

    public static function enableByName($name)
    {
        return self::post('enable', ['name' => $name]);
    }

    public static function disable($id)
    {
        return self::post('disable', ['id' => $id]);
    }

    public static function disableByName($name)
    {
        return self::post('disable', ['name' => $name]);
    }

    public static function toggle($id)
    {
        return self::post('toggle', ['id' => $id]);
    }

    public static function toggleByName($name)
    {
        return self::post('toggle', ['name' => $name]);
    }

    public static function enabled($id)
    {
        return self::post('is/enabled', ['id' => $id]);
    }

    public static function enabledByName($name)
    {
        return self::post('is/enabled', ['name' => $name]);
    }

    public static function enabledFor($id, $roles = null)
    {
        return self::post('is/enabled-for', ['id' => $id, 'roles' => $roles]);
    }

    public static function enabledForByName($name, $roles = null)
    {
        return self::post('is/enabled-for', ['name' => $name, 'roles' => $roles]);
    }

    public static function attachRole($featureId, $roleId)
    {
        return self::post('attach', ['id' => $featureId, 'role_id' => $roleId]);
    }

    public static function attachRoleByName($featureName, $roleId)
    {
        return self::post('attach', ['name' => $featureName, 'role_id' => $roleId]);
    }

    public static function detachRole($featureId, $roleId)
    {
        return self::post('detach', ['id' => $featureId, 'role_id' => $roleId]);
    }

    public static function detachRoleByName($featureName, $roleId)
    {
        return self::post('detach', ['name' => $featureName, 'role_id' => $roleId]);
    }

    public static function syncRoles($featureId, $roleIds)
    {
        return self::post('sync', ['id' => $featureId, 'role_ids' => $roleIds]);
    }

    public static function syncRolesByName($featureName, $rolesIds)
    {
        return self::post('sync', ['name' => $featureName, 'role_ids' => $roleIds]);
    }

    public static function transformer()
    {
        return new ApiTransformer;
    }

    public static function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
