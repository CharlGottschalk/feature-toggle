<?php

namespace CharlGottschalk\FeatureToggle\Http\Controllers;

use CharlGottschalk\FeatureToggle\FeatureManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeaturesController extends BaseController
{
    public function index(Request $request)
    {
        $features = FeatureManager::index(20, $request->input('page'));
        return view('feature-toggle::index', compact('features'));
    }

    public function edit(Request $request, $id)
    {
        $feature = FeatureManager::show($id);

        if (empty($feature)) {
            return redirect()->route('features.toggle.index')->with('alert', ['type' => 'error', 'message' => "Could not find that feature"]);
        }

        return view('feature-toggle::edit', compact('feature'));
    }

    public function store(Request $request)
    {
        $rules = config('features.driver')::rules();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('features.toggle.index')
                ->withErrors($validator)
                ->withInput();
        }

        $enabled = $request->has('enabled');

        $feature = FeatureManager::store($request->input('name'), $enabled);

        if (empty($feature)) {
            return redirect()->route('features.toggle.index')->with('alert', ['type' => 'error', 'message' => "Error storing feature"]);
        }

        return redirect()->route('features.toggle.index')->with('alert', ['type' => 'success', 'message' => "{$feature->name} added"]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role_ids' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('features.toggle.index')
                ->withErrors($validator)
                ->withInput();
        }

        $feature = FeatureManager::update($id, $request->input('role_ids'));

        if (empty($feature)) {

            return redirect()->route('features.toggle.index')->with('alert', ['type' => 'error', 'message' => "Could not find that feature"]);
        }

        return redirect()->route('features.toggle.index')->with('alert', ['type' => 'success', 'message' => "{$feature->name} roles updated"]);
    }

    public function delete($id)
    {
        if (FeatureManager::delete($id)) {
            return redirect()->route('features.toggle.index')->with('alert', ['type' => '', 'message' => "Feature removed"]);
        }

        return redirect()->route('features.toggle.index')->with('alert', ['type' => 'error', 'message' => "Error removing that feature"]);
    }

    public function enable($id)
    {
        $feature = FeatureManager::enable($id);

        if (empty($feature)) {
            return redirect()->route('features.toggle.index')->with('alert', ['type' => 'error', 'message' => "Error enabling that feature"]);
        }

        return redirect()->route('features.toggle.index')->with('alert', ['type' => 'default', 'message' => "{$feature->name} enabled"]);
    }

    public function disable($id)
    {
        $feature = FeatureManager::disable($id);

        if (empty($feature)) {
            return redirect()->route('features.toggle.index')->with('alert', ['type' => 'error', 'message' => "Error disabling that feature"]);
        }

        return redirect()->route('features.toggle.index')->with('alert', ['type' => '', 'message' => "{$feature->name} disabled"]);
    }
}
