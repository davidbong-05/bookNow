<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookingsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

/**
 * Class BookingsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookingsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Bookings::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bookings');
        CRUD::setEntityNameStrings('bookings', 'bookings');
    }

    protected function setupListOperation()
    {
        CRUD::addClause('whereDate', 'date', '>', Carbon::now());
        CRUD::addClause('where', 'status', '!=', 'pending');
        CRUD::addColumn([
            'type'  => 'string',
            'name'  => 'user_id',
            'label' => 'Staff ID / Matric No.',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('user_id', 'like', '%' . $searchTerm . '%');
            }
        ]);

        CRUD::addColumn([
            'label'     => 'Name',
            'type'      => 'select',
            'name'      => 'user_id',
            'key'       => 'user_name',
            'entity'    => 'user',
            'attribute' => 'name',
            'model'     => 'App\Models\User',
        ]);
        CRUD::column('courts_id');
        CRUD::column('remark');
        CRUD::addColumn([
            'label'     => 'Date',
            'type'      => 'date',
            'name'      => 'date',
        ]);
        CRUD::addColumn([
            'label'     => 'Time',
            'type'      => 'time',
            'name'      => 'time',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BookingsRequest::class);

        CRUD::field('user_id');
        CRUD::field('courts_id');
        CRUD::field('remark');
        CRUD::field('date');

        CRUD::addField([
            'name'  => 'time',
            'label' => 'Time',
            'type'  => 'select_from_array',
            'options' => [
                '09:00:00' => '09:00',
                '10:00:00' => '10:00',
                '11:00:00' => '11:00',
                '12:00:00' => '12:00',
                '13:00:00' => '13:00',
                '14:00:00' => '14:00',
                '15:00:00' => '15:00',
                '16:00:00' => '16:00',
                '17:00:00' => '17:00',
                '18:00:00' => '18:00',
                '19:00:00' => '19:00',
                '20:00:00' => '20:00',
                '21:00:00' => '21:00'
            ],

        ]);

        CRUD::addField([
            'name'  => 'status',
            'label' => 'Status',
            'type'  => 'select_from_array',
            'options' => [
                'Approved' => 'Approved',
                'Pending' => 'Pending',
                'Rejected' => 'Rejected',
                'Cancelled' => 'Cancelled'
            ],

        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::addColumn([
            'type'  => 'string',
            'name'  => 'user_id',
            'label' => 'Staff ID / Matric No.'
        ]);
        CRUD::addColumn([
            'label'     => 'Name',
            'type'      => 'select',
            'name'      => 'user_id',
            'key'       => 'user_name',
            'entity'    => 'user',
            'attribute' => 'name',
            'model'     => 'App\Models\User',
        ]);
        CRUD::column('courts_id');
        $this->autoSetupShowOperation();
    }
}