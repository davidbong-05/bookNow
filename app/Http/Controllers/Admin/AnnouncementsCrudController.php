<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnnouncementsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnnouncementsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnnouncementsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Announcements::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/announcements');
        CRUD::setEntityNameStrings('announcements', 'announcements');
    }
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'body',
            'type' => 'text',
            'label' => 'Content',
        ]);
        CRUD::addColumn([
            'name' => 'created_at',
            'type' => 'datetime',
            'label' => 'Published at',
        ]);
    }
    protected function setupCreateOperation()
    {
        CRUD::addField([
            'name'  => 'body',
            'label' => 'Announcement Content',
            'type'  => 'textarea',
        ]);
        $rules = ['body' => 'required|max:255'];
        $messages = [
            'body.required' => 'Do not leave it empty... bro',
            'body.max' => 'Bro, too long Bro',
        ];
        CRUD::setValidation($rules, $messages);
    }
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}