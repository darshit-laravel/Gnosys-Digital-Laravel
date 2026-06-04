<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use App\Models\CustomFieldType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customfields = CustomField::query()->with('fieldType:id,name')->select([
            'id','custom_field_type_id','name','module_type','status'
        ])->paginate(10);

        return view('admin.custom-fields.index', compact('customfields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customfieldtypes = CustomFieldType::query()->select(['id','name'])->where('status', 1)->pluck('name', 'id');

        return view('admin.custom-fields.create', compact('customfieldtypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_type' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:custom_fields,name',
            'custom_field_type_id' => 'required|exists:custom_field_types,id',
            'status' => 'required|in:0,1'
        ]);

        $slug = Str::slug($request->name);

        if (CustomField::where('slug', $slug)->exists()) {
            return back()
                ->withErrors(['name' => 'A custom field with this slug already exists.'])
                ->withInput();
        }

        $Customfield = CustomField::create([
            'module_type' => $request->module_type,
            'name' => $request->name,
            'slug' => $slug,
            'custom_field_type_id' => $request->custom_field_type_id,
            'status' => $request->status,
            'options' => !empty($request->options) ? json_encode($request->options) : '',
            'params' => !empty($request->params) ? json_encode($request->params) : ''
        ]);

        return redirect()->route('admin.custom.fields.index')->with('success', 'Custom field added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomField $customField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customfield = CustomField::query()->where('id', $id)->first();
        $customfieldtypes = CustomFieldType::query()->select(['id','name'])->where('status', 1)->pluck('name', 'id');

        return view('admin.custom-fields.edit', compact('customfield','customfieldtypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $custom_field)
    {
        $request->validate([
            'module_type' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:custom_fields,name,' . $custom_field,
            'custom_field_type_id' => 'required|exists:custom_field_types,id',
            'status' => 'required|in:0,1'
        ]);

        $Customfield = CustomField::where('id', $custom_field)
        ->update([
            // 'module_type' => $request->module_type,
            'name' => $request->name,
            // 'custom_field_type_id' => $request->custom_field_type_id,
            'status' => $request->status,
            'options' => !empty($request->options) ? json_encode($request->options) : '',
            'params' => !empty($request->params) ? json_encode($request->params) : ''
        ]);

        return redirect()->route('admin.custom.fields.index')->with('success', 'Custom field updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($custom_field)
    {
        CustomField::where('id', $custom_field)->delete();
        return redirect()->route('admin.custom.fields.index')->with('success', 'Custom field deleted successfully.');
    }

    public function getFieldTypeData(Request $request) {
        $request->validate([
            'type_id' => 'required|exists:custom_field_types,id'
        ]);

        $fieldType = CustomFieldType::findOrFail($request->type_id);

        $fieldTypeParams = json_decode($fieldType->params, true) ?? [];
        $options = json_decode($request->options, true) ?? [];
        $params = json_decode($request->params, true) ?? [];

        $html = view('admin.custom-fields.type_settings', [
            'fieldType' => $fieldType,
            'field_type_params' => $fieldTypeParams,
            'options' => $options,
            'params' => $params,
        ])->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
}
