<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FacilitiesRequest;
use App\Models\Facilities;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\File;

/**
 * Class FacilitiesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FacilitiesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Facilities::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/facilities');
        CRUD::setEntityNameStrings('facilities', 'facilities');
    }
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name'      => 'name',
            'label'     => 'Facility'
        ]);
        CRUD::addColumn([
            'name'      => 'image',
            'label'     => 'Image',
            'type'      => 'image',
            'height' => '10rem',
            'width'  => '15rem',
        ]);
        CRUD::column('description');
        CRUD::column('updated_at');
    }
    protected function setupCreateOperation()
    {
        CRUD::field('name');
        CRUD::field('description');

        CRUD::addField([
            'name'  => 'image',
            'label' => 'Image',
            'type'  => 'upload',
            'upload' => 'cloudinary',
        ]);

        CRUD::setValidation([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'required'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}