<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            'type'  => 'string',
            'name'  => 'id',
            'label' => 'Staff ID / Matric No.',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('id', 'like', '%' . $searchTerm . '%');
            }
        ]);
        CRUD::column('role');
        CRUD::column('name');
        CRUD::column('faculty');
        CRUD::addColumn([
            'type'  => 'email',
            'name'  => 'email',
            'label' => 'Email',
        ]);
        CRUD::addColumn([
            'type'  => 'phone',
            'name'  => 'mobileNum',
            'label' => 'Mobile No.',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::field('id');
        CRUD::field('role');
        CRUD::field('name');
        CRUD::field('faculty');
        CRUD::field('email');
        CRUD::field('mobileNum');
        CRUD::field('password');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}